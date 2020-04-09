<?php
/**
 * 2020 Packlink
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Apache License 2.0
 * that is bundled with this package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 * http://www.apache.org/licenses/LICENSE-2.0.txt
 *
 * @author    Packlink <support@packlink.com>
 * @copyright 2020 Packlink Shipping S.L
 * @license   http://www.apache.org/licenses/LICENSE-2.0.txt  Apache License 2.0
 */

use Logeecom\Infrastructure\Logger\Logger;
use Logeecom\Infrastructure\ORM\RepositoryRegistry;
use Logeecom\Infrastructure\ServiceRegister;
use Packlink\BusinessLogic\Order\Interfaces\OrderRepository as OrderRepositoryInterface;
use Packlink\BusinessLogic\Order\Models\OrderShipmentDetails;
use Packlink\PrestaShop\Classes\Repositories\OrderRepository;
use Packlink\PrestaShop\Classes\Utility\PacklinkPrestaShopUtility;
use Packlink\PrestaShop\Classes\Utility\TranslationUtility;

/** @noinspection PhpIncludeInspection */
require_once rtrim(_PS_MODULE_DIR_, '/') . '/packlink/vendor/autoload.php';

/**
 * Class BulkShipmentLabelsController
 */
class BulkShipmentLabelsController extends PacklinkBaseController
{
    const FILE_NAME = 'packlink_labels.pdf';

    /**
     * Controller entry endpoint.
     */
    public function initContent()
    {
        $result = false;

        try {
            $result = $this->bulkPrintLabels();
        } catch (\Exception $e) {
            Logger::logError(
                TranslationUtility::__('Unable to create bulk labels file'),
                'Integration'
            );
        }

        if ($result !== false) {
            // Filename is required because generated temp name is random.
            PacklinkPrestaShopUtility::dieInline($result, self::FILE_NAME);
        }

        PacklinkPrestaShopUtility::die400();
    }

    /**
     * Prints all available shipment labels in one merged PDF document.
     *
     * @return bool|string File path of the final merged PDF document; FALSE on error.
     *
     * @throws \Logeecom\Infrastructure\Http\Exceptions\HttpAuthenticationException
     * @throws \Logeecom\Infrastructure\Http\Exceptions\HttpCommunicationException
     * @throws \Logeecom\Infrastructure\Http\Exceptions\HttpRequestException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\QueryFilterInvalidParamException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     * @throws \PrestaShopDatabaseException
     * @throws \PrestaShopException
     * @throws \iio\libmergepdf\Exception
     */
    protected function bulkPrintLabels()
    {
        $outputPath = false;
        $tmpDirectory = _PS_MODULE_DIR_ . 'packlink/tmp';
        $paths = $this->prepareAllLabels($tmpDirectory);

        if (count($paths) === 1) {
            return $paths[0];
        }

        $now = date('Y-m-d');
        $merger = new \iio\libmergepdf\Merger();
        $merger->addIterator($paths);
        $outputFile = $merger->merge();
        if (!empty($outputFile)) {
            $bulkLabelDirectory = _PS_MODULE_DIR_ . 'packlink/labels';
            /** @noinspection MkdirRaceConditionInspection */
            if (!is_dir($bulkLabelDirectory) && !mkdir($bulkLabelDirectory)) {
                throw new \RuntimeException(
                    TranslationUtility::__('Directory "%s" was not created', array($bulkLabelDirectory))
                );
            }

            $outputPath = $bulkLabelDirectory . "/Packlink-bulk-shipment-labels_$now.pdf";
            file_put_contents($outputPath, $outputFile);
        }

        \Tools::deleteDirectory($tmpDirectory);

        return $outputPath;
    }

    /**
     * @param string $tmpDirectory
     *
     * @return array
     *
     * @throws \Logeecom\Infrastructure\Http\Exceptions\HttpAuthenticationException
     * @throws \Logeecom\Infrastructure\Http\Exceptions\HttpCommunicationException
     * @throws \Logeecom\Infrastructure\Http\Exceptions\HttpRequestException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\QueryFilterInvalidParamException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     * @throws \PrestaShopDatabaseException
     * @throws \PrestaShopException
     */
    protected function prepareAllLabels($tmpDirectory)
    {
        $orderIds = \Tools::getValue('orders');

        /** @noinspection MkdirRaceConditionInspection */
        if (!empty($orderIds) && !is_dir($tmpDirectory) && !mkdir($tmpDirectory)) {
            throw new \RuntimeException(
                TranslationUtility::__('Directory "%s" was not created', array($tmpDirectory))
            );
        }

        return $this->saveFilesLocally($orderIds);
    }

    /**
     * Saves PDF files to temporary directory on the system.
     *
     * @param array $orderIds
     *
     * @return array An array of paths of the saved files.
     *
     * @throws \Logeecom\Infrastructure\Http\Exceptions\HttpAuthenticationException
     * @throws \Logeecom\Infrastructure\Http\Exceptions\HttpCommunicationException
     * @throws \Logeecom\Infrastructure\Http\Exceptions\HttpRequestException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\QueryFilterInvalidParamException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     * @throws \PrestaShopDatabaseException
     * @throws \PrestaShopException
     */
    private function saveFilesLocally(array $orderIds)
    {
        $result = array();
        $orderDetailsRepository = RepositoryRegistry::getRepository(OrderShipmentDetails::getClassName());
        /** @var OrderRepository $orderRepository */
        $orderRepository = ServiceRegister::getService(OrderRepositoryInterface::CLASS_NAME);
        /** @var \Packlink\BusinessLogic\Order\OrderService $orderService */
        $orderService = ServiceRegister::getService(\Packlink\BusinessLogic\Order\OrderService::CLASS_NAME);

        foreach ($orderIds as $orderId) {
            $orderDetails = $orderRepository->getOrderDetailsById((int)$orderId);
            if ($orderDetails !== null) {
                $shipmentLabels = $orderDetails->getShipmentLabels();
                if (empty($shipmentLabels)) {
                    $shipmentLabels = $orderService->getShipmentLabels($orderDetails->getReference());
                    $orderDetails->setShipmentLabels($shipmentLabels);
                }

                $labels = $orderDetails->getShipmentLabels();

                foreach ($labels as $label) {
                    if (!$label->isPrinted()) {
                        $label->setPrinted(true);
                    }

                    $path = $this->savePDF($label->getLink());
                    if (!empty($path)) {
                        $result[] = $path;
                    }
                }

                $orderDetailsRepository->update($orderDetails);
            } else {
                Logger::logWarning(TranslationUtility::__('Order details not found'), 'Integration');
            }
        }

        return $result;
    }

    /**
     * Saves PDF file from provided URL to temporary location on the system.
     *
     * @param string $link Web link to the PDF file.
     *
     * @return string | boolean Path to the saved file
     */
    private function savePDF($link)
    {
        if (($data = \Tools::file_get_contents($link)) === false) {
            return $data;
        }

        $file = tempnam(sys_get_temp_dir(), 'packlink_pdf');
        file_put_contents($file, $data);

        return $file;
    }
}
