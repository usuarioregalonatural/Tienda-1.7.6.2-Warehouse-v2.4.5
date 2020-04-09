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

use Logeecom\Infrastructure\AutoTest\AutoTestLogger;
use Logeecom\Infrastructure\AutoTest\AutoTestService;
use Logeecom\Infrastructure\Exceptions\StorageNotAccessibleException;
use Packlink\PrestaShop\Classes\InfrastructureServices\LoggerService;
use Packlink\PrestaShop\Classes\Utility\PacklinkPrestaShopUtility;
use Packlink\PrestaShop\Classes\Utility\TranslationUtility;

/** @noinspection PhpIncludeInspection */
require_once rtrim(_PS_MODULE_DIR_, '/') . '/packlink/vendor/autoload.php';

/**
 * Class PacklinkAutoTestController.
 */
class PacklinkAutoTestController extends PacklinkBaseController
{
    /**
     * PacklinkAutoTestController constructor.
     *
     * @throws \PrestaShopException
     */
    public function __construct()
    {
        parent::__construct();

        $this->page_header_toolbar_title = $this->l('PacklinkPRO module auto-test', 'packlink');
        $this->meta_title = $this->page_header_toolbar_title;
    }

    /**
     * Controller entry endpoint.
     *
     * @throws \SmartyException
     * @throws \PrestaShopException
     */
    public function initContent()
    {
        $action = Tools::getValue('action');

        if (!$action) {
            $this->displayPage();

            return;
        }

        if (method_exists($this, $action)) {
            $this->$action();
        }

        PacklinkPrestaShopUtility::die400();
    }

    /**
     * Displays main Auto-test page.
     *
     * @throws \SmartyException
     * @throws \PrestaShopException
     */
    protected function displayPage()
    {
        parent::initContent();

        $path = $this->module->getPathUri();
        $this->addCSS(
            array(
                $path . 'views/css/auto-test.css?v=' . $this->module->version,
                $path . 'views/css/packlink.css?v=' . $this->module->version,
                $path . 'views/css/bootstrap-prestashop-ui-kit.css?v=' . $this->module->version,
            ),
            'all',
            null,
            false
        );
        $this->addJS(
            array(
                $path . 'views/js/core/UtilityService.js?v=' . $this->module->version,
                $path . 'views/js/core/TemplateService.js?v=' . $this->module->version,
                $path . 'views/js/core/AjaxService.js?v=' . $this->module->version,
                $path . 'views/js/core/AutoTestController.js?v=' . $this->module->version,
                $path . 'views/js/PrestaFix.js?v=' . $this->module->version,
            ),
            false
        );

        // assign template variables
        $this->context->smarty->assign(
            array(
                'dashboardLogo' => $path . 'views/img/logo-pl.svg',
                'startTestUrl' => $this->getAction('PacklinkAutoTest', 'start'),
                'checkStatusUrl' => $this->getAction('PacklinkAutoTest', 'checkStatus'),
                'downloadLogUrl' => $this->getAction('PacklinkAutoTest', 'exportLogs', false),
                'systemInfoUrl' => $this->getAction('Debug', 'getSystemInfo', false),
                'moduleUrl' => $this->getAction('Packlink', '', false),
            )
        );
        // render template and assign it to the page
        $content = $this->context->smarty->fetch($this->getTemplatePath() . 'auto-test.tpl');
        $this->context->smarty->assign(
            array(
                'content' => $content,
            )
        );
    }

    /**
     * Runs the auto-test and returns the queue item ID.
     *
     * @throws \Logeecom\Infrastructure\TaskExecution\Exceptions\QueueStorageUnavailableException
     */
    protected function start()
    {
        $service = new AutoTestService();
        try {
            PacklinkPrestaShopUtility::dieJson(array('success' => true, 'itemId' => $service->startAutoTest()));
        } catch (StorageNotAccessibleException $e) {
            PacklinkPrestaShopUtility::dieJson(
                array(
                    'success' => false,
                    'error' => TranslationUtility::__('Database not accessible.'),
                )
            );
        }
    }

    /**
     * Checks the status of the auto-test task.
     *
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\QueryFilterInvalidParamException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryClassException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     */
    protected function checkStatus()
    {
        $service = new AutoTestService();
        $status = $service->getAutoTestTaskStatus(Tools::getValue('queueItemId', 0));

        if ($status->finished) {
            $service->stopAutoTestMode(
                function () {
                    return LoggerService::getInstance();
                }
            );
        }

        PacklinkPrestaShopUtility::dieJson(
            array(
                'finished' => $status->finished,
                'error' => TranslationUtility::__($status->error),
                'logs' => AutoTestLogger::getInstance()->getLogsArray(),
            )
        );
    }

    /**
     * Exports all logs as a JSON file.
     *
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     */
    protected function exportLogs()
    {
        if (!defined('JSON_PRETTY_PRINT')) {
            define('JSON_PRETTY_PRINT', 128);
        }

        $data = json_encode(AutoTestLogger::getInstance()->getLogsArray(), JSON_PRETTY_PRINT);
        PacklinkPrestaShopUtility::dieFileFromString($data, 'auto-test-logs.json');
    }

    /**
     * Retrieves ajax action.
     *
     * @param string $controller
     * @param string $action
     * @param bool $ajax
     *
     * @return string
     *
     * @throws \PrestaShopException
     */
    private function getAction($controller, $action, $ajax = true)
    {
        return $this->context->link->getAdminLink($controller) . '&' .
            http_build_query(
                array(
                    'ajax' => $ajax,
                    'action' => $action,
                )
            );
    }
}
