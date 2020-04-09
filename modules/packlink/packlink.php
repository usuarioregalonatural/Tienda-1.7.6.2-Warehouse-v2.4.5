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

/** @noinspection PhpUnusedParameterInspection */

if (!defined('_PS_VERSION_')) {
    exit;
}

/** @noinspection PhpIncludeInspection */
require_once rtrim(_PS_MODULE_DIR_, '/') . '/packlink/vendor/autoload.php';

/**
 * @property bool bootstrap
 * @property string module_key
 * @property string name
 * @property string tab
 * @property string version
 * @property string author
 * @property int need_instance
 * @property array ps_versions_compliancy
 * @property string displayName
 * @property string description
 * @property \ContextCore context
 * @method string display($file, $template, $cache_id = null, $compile_id = null)
 * @method unregisterHook($string)
 */
class Packlink extends CarrierModule
{
    const PACKLINK_SHIPPING_TAB = 'views/templates/admin/packlink_shipping_tab/shipping_tab.tpl';
    const PACKLINK_SHIPPING_CONTENT = 'views/templates/admin/packlink_shipping_content/shipping_content.tpl';
    const PRESTASHOP_ORDER_CREATED_STATUS = 0;
    const PRESTASHOP_PAYMENT_ACCEPTED_STATUS = 2;
    const PRESTASHOP_PROCESSING_IN_PROGRESS_STATUS = 3;
    /**
     * Id of current carrier. This variable will be set by Presta when
     * method for calculating shipping cost is called.
     * @var int
     */
    public $id_carrier;
    /**
     * List of help URLs for different country codes.
     *
     * @var array
     */
    private static $helpUrls = array(
        'ES' => 'https://support-pro.packlink.com/hc/es-es/sections/202755109-Prestashop',
        'DE' => 'https://support-pro.packlink.com/hc/de/sections/202755109-Prestashop',
        'FR' => 'https://support-pro.packlink.com/hc/fr-fr/sections/202755109-Prestashop',
        'IT' => 'https://support-pro.packlink.com/hc/it/sections/202755109-Prestashop',
    );
    /**
     * List of terms and conditions URLs for different country codes.
     *
     * @var array
     */
    private static $termsAndConditionsUrls = array(
        'ES' => 'https://pro.packlink.es/terminos-y-condiciones/',
        'DE' => 'https://pro.packlink.de/agb/',
        'FR' => 'https://pro.packlink.fr/conditions-generales/',
        'IT' => 'https://pro.packlink.it/termini-condizioni/',
    );
    /**
     * List of country names for different country codes.
     *
     * @var array
     */
    private static $countryNames = array(
        'ES' => 'Spain',
        'DE' => 'Germany',
        'FR' => 'France',
        'IT' => 'Italy',
    );

    /**
     * Packlink constructor.
     */
    public function __construct()
    {
        $this->module_key = 'a7a3a395043ca3a09d703f7d1c74a107';
        $this->name = 'packlink';
        $this->tab = 'shipping_logistics';
        $this->version = '2.1.5';
        $this->author = $this->l('Packlink Shipping S.L.');
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6.0.14', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Packlink PRO Shipping');
        $this->description = $this->l('Save up to 70% on your shipping costs. No fixed fees, no minimum shipping volume required. Manage all your shipments in a single platform.');

        $this->context = Context::getContext();
    }

    /**
     * Handle plugin installation
     *
     * @return bool
     *
     * @throws \PrestaShopException
     * @throws \PrestaShop\PrestaShop\Adapter\CoreException
     */
    public function install()
    {
        $installer = new \Packlink\PrestaShop\Classes\Utility\PacklinkInstaller($this);
        $previousShopContext = Shop::getContext();
        Shop::setContext(Shop::CONTEXT_ALL);

        $result = $installer->initializePlugin() && parent::install() && $installer->addControllersAndHooks();

        Shop::setContext($previousShopContext);

        return $result;
    }

    /**
     * Install overridden files from the module.
     *
     * @return bool
     */
    public function installOverrides()
    {
        $this->uninstallOverrides();
        $installer = new \Packlink\PrestaShop\Classes\Utility\PacklinkInstaller($this);
        $installer->removeOldOverrides();
        if (!$installer->shouldInstallOverrides()) {
            // skip installing overrides / do not call parent method
            return true;
        }

        return parent::installOverrides();
    }

    /**
     * Enables the module.
     *
     * @param bool $force_all
     *
     * @return bool
     */
    public function enable($force_all = false)
    {
        if (version_compare(_PS_VERSION_, '1.7', '<')) {
            // v1.7+ installs overrides on enable and 1.6 does not.
            $this->installOverrides();
        }

        return parent::enable($force_all);
    }

    /**
     * Disables the module.
     *
     * @param bool $force_all
     *
     * @return bool
     */
    public function disable($force_all = false)
    {
        if (version_compare(_PS_VERSION_, '1.7', '<')) {
            // v1.7+ uninstalls overrides on disable and 1.6 does not.
            $this->uninstallOverrides();
        }

        return parent::disable($force_all);
    }

    /**
     * Handle plugin uninstall
     *
     * @return bool
     * @throws \PrestaShop\PrestaShop\Adapter\CoreException
     */
    public function uninstall()
    {
        $installer = new \Packlink\PrestaShop\Classes\Utility\PacklinkInstaller($this);

        return $installer->uninstall() && parent::uninstall() && $installer->removeHooks();
    }

    /**
     * Hook used to insert content before carriers have been loaded.
     *
     * @param array $params
     *
     * @return string
     *
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\QueryFilterInvalidParamException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     * @throws \PrestaShopDatabaseException
     * @throws \PrestaShopException
     */
    public function hookDisplayBeforeCarrier($params)
    {
        $output = $this->getLocationPickerFilesLinks();

        if (version_compare(_PS_VERSION_, '1.7.0.0', '<')) {
            return $output . $this->getPresta16ShippingStepPage($params);
        }

        $shippingServicePath = $this->_path . 'views/js/ShippingService17.js?v=' . $this->version;
        $output .= "<script src=\"{$shippingServicePath}\"></script>\n";

        $output .= $this->getCheckoutFilesLinks();

        return $output;
    }

    /**
     * Hook used to insert html and javascript after carriers have been loaded on frontend.
     *
     * @param array $params
     *
     * @return string
     *
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\QueryFilterInvalidParamException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     * @throws \PrestaShopDatabaseException
     * @throws \PrestaShopException
     */
    public function hookDisplayAfterCarrier($params)
    {
        $configuration = $this->getShippingStepConfiguration($params);

        $this->context->smarty->assign(array(
            'configuration' => json_encode($configuration),
        ));

        return $this->display(__FILE__, 'shipping_methods_17.tpl');
    }

    /**
     * Hooks on tab display to add shipping tab.
     *
     * @return string Rendered template output.
     *
     * @throws \SmartyException
     */
    public function hookDisplayAdminOrderTabShip()
    {
        \Packlink\PrestaShop\Classes\Bootstrap::init();

        if (!$this->moduleFullyConfigured()) {
            return '';
        }

        return $this->context->smarty->createTemplate(
            $this->getLocalPath() . self::PACKLINK_SHIPPING_TAB,
            $this->context->smarty
        )->fetch();
    }

    /**
     * Hooks on content display to add Packlink shipping content.
     *
     * @return string Rendered template output.
     *
     * @throws \Exception
     */
    public function hookDisplayAdminOrderContentShip()
    {
        \Packlink\PrestaShop\Classes\Bootstrap::init();

        if (!$this->moduleFullyConfigured()) {
            return '';
        }

        $orderId = (int)Tools::getValue('id_order');

        $this->prepareShippingTabData($orderId);

        $this->context->controller->addJS(
            array(
                $this->_path . 'views/js/PrestaCreateOrderDraft.js?v=' . $this->version,
                $this->_path . 'views/js/core/AjaxService.js?v=' . $this->version,
                $this->_path . 'views/js/PrestaAjaxService.js?v=' . $this->version,
            ),
            false
        );

        return $this->context->smarty->createTemplate(
            $this->getLocalPath() . self::PACKLINK_SHIPPING_CONTENT,
            $this->context->smarty
        )->fetch();
    }

    /**
     * Frontend hook for order creation.
     *
     * @param array $params Hook parameters.
     *
     * @return string
     *
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\QueryFilterInvalidParamException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     * @throws \PrestaShopDatabaseException
     * @throws \PrestaShopException
     */
    public function hookDisplayOrderConfirmation($params)
    {
        \Packlink\PrestaShop\Classes\Bootstrap::init();

        /** @var \Order $order */
        $order = $params['order'] ?: $params['objOrder'];
        $cartId = $order->id_cart;
        $carrierId = $order->id_carrier;
        if (\Packlink\PrestaShop\Classes\Utility\CarrierUtility::isDropOff((int)$carrierId)
            && !\Packlink\PrestaShop\Classes\Utility\CheckoutUtility::isDropOffSelected(
                (string)$cartId,
                (string)$carrierId
            )
        ) {
            $configuration = $this->getShippingStepConfiguration($params);
            $configuration['id'] = $carrierId;
            $configuration['orderId'] = $order->id;
            $configuration['addressId'] = $order->id_address_delivery;
            $configuration['cartId'] = $order->id_cart;
            $this->context->smarty->assign(
                array('configuration' => json_encode($configuration))
            );

            $output = $this->getLocationPickerFilesLinks();

            $output .= $this->getCheckoutFilesLinks();
            $output .= $this->display(__FILE__, 'confirm.tpl');

            return $output;
        }

        return '';
    }

    /**
     * Hook for order creation.
     *
     * @param array $params Hook parameters.
     *
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\QueryFilterInvalidParamException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     * @throws \Logeecom\Infrastructure\TaskExecution\Exceptions\QueueStorageUnavailableException
     * @throws \PrestaShopDatabaseException
     * @throws \PrestaShopException
     */
    public function hookActionValidateOrder($params)
    {
        \Packlink\PrestaShop\Classes\Bootstrap::init();

        /** @var \Order $order */
        $order = $params['order'];
        $isDelayed = false;

        if (\Packlink\PrestaShop\Classes\Utility\CarrierUtility::isDropOff((int)$order->id_carrier)) {
            $isDropOffSelected = \Packlink\PrestaShop\Classes\Utility\CheckoutUtility::isDropOffSelected(
                (string)$order->id_cart,
                (string)$order->id_carrier
            );

            if ($isDropOffSelected) {
                $this->createDropOffAddress($order);
            } else {
                $isDelayed = true;
            }
        }

        $this->createOrderDraft($params['order'], $params['orderStatus'], $isDelayed);
    }

    /**
     * Hook that is triggered when order status is updated on backend.
     *
     * @param $params
     *
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\QueryFilterInvalidParamException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     * @throws \Logeecom\Infrastructure\TaskExecution\Exceptions\QueueStorageUnavailableException
     * @throws \PrestaShopDatabaseException
     * @throws \PrestaShopException
     */
    public function hookActionOrderStatusUpdate($params)
    {
        \Packlink\PrestaShop\Classes\Bootstrap::init();

        $order = new \Order((int)$params['id_order']);

        // If order has just been created, this hook should not handle that event
        // since it has already been handled by hook for validating order.
        if ((int)$order->current_state !== self::PRESTASHOP_ORDER_CREATED_STATUS
            && array_key_exists('newOrderStatus', $params)
        ) {
            $this->createOrderDraft($order, $params['newOrderStatus']);
        }
    }

    /**
     * Front Methods
     *
     * If you set need_range at true when you created your carrier,
     * the method called by the cart will be getOrderShippingCost.
     * If not, the method called will be getOrderShippingCostExternal
     *
     * $params var contains the cart, the customer, the address
     * $shipping_cost var contains the price calculated by the range in carrier tab
     *
     * @param \Cart $cart Shopping cart object.
     * @param int $shippingCost Shipping cost calculated by PrestaShop.
     * @param array $products Array of shop products for which shipping cost is calculated.
     *
     * @return float | bool Calculated shipping cost if carrier is available, otherwise FALSE.
     *
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\QueryFilterInvalidParamException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     * @throws \PrestaShopException
     * @throws \PrestaShop\PrestaShop\Adapter\CoreException
     */
    public function getPackageShippingCost($cart, $shippingCost, $products)
    {
        $cost = \Packlink\PrestaShop\Classes\ShippingServices\PackageCostCalculator::getPackageCost(
            $cart,
            $products,
            $this->id_carrier
        );

        if (!empty($cost) && !empty($shippingCost)) {
            $cost += $shippingCost;
        }

        return $cost;
    }

    /**
     * Required by base class.
     *
     * @param $params
     * @param $shipping_cost
     */
    public function getOrderShippingCost($params, $shipping_cost)
    {
    }

    /**
     * Required by base class.
     *
     * @param $params
     */
    public function getOrderShippingCostExternal($params)
    {
    }

    /**
     * Returns content.
     *
     * @return string
     *
     * @throws \PrestaShopException
     * @throws \Logeecom\Infrastructure\TaskExecution\Exceptions\QueueStorageUnavailableException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     */
    public function getContent()
    {
        \Packlink\PrestaShop\Classes\Bootstrap::init();

        $output = '';

        /** @var \Packlink\PrestaShop\Classes\BusinessLogicServices\ConfigurationService $configService */
        $configService = \Logeecom\Infrastructure\ServiceRegister::getService(
            \Packlink\BusinessLogic\Configuration::CLASS_NAME
        );
        $apiToken = $configService->getAuthorizationToken();
        $loggedIn = false;

        if (!$apiToken && Tools::isSubmit('api_key')) {
            $loggedIn = $this->login();

            if (!$loggedIn) {
                $output .= $this->displayError(
                    \Packlink\PrestaShop\Classes\Utility\TranslationUtility::__('API key was incorrect.')
                );
            }
        }

        /** @var \Logeecom\Infrastructure\TaskExecution\Interfaces\TaskRunnerWakeup $wakeupService */
        $wakeupService = \Logeecom\Infrastructure\ServiceRegister::getService(
            \Logeecom\Infrastructure\TaskExecution\Interfaces\TaskRunnerWakeup::CLASS_NAME
        );
        $wakeupService->wakeup();

        $fancyBoxUrl = _PS_BASE_URL_ . __PS_BASE_URI__ . 'js/jquery/plugins/fancybox/jquery.fancybox.js';
        $fancyBoxUrl = str_replace(array('https:', 'http:'), '', $fancyBoxUrl);

        $this->context->smarty->assign(array(
            'fancyBoxPath' => $fancyBoxUrl,
        ));

        if ($apiToken || $loggedIn) {
            return $this->renderConfigForm();
        }

        $this->context->controller->addCSS(
            array(
                $this->_path . 'views/css/packlink.css?v=' . $this->version,
                $this->_path . 'views/css/bootstrap-prestashop-ui-kit.css?v=' . $this->version,
            ),
            'all',
            null,
            false
        );
        $this->context->controller->addJS(
            array(
                $this->_path . 'views/js/prestashop-ui-kit.js?v=' . $this->version,
                $this->_path . 'views/js/core/UtilityService.js?v=' . $this->version,
                $this->_path . 'views/js/PrestaFix.js?v=' . $this->version,
                $this->_path . 'views/js/Login.js?v=' . $this->version,
            ),
            false
        );

        $this->context->smarty->assign(array(
            'iconPath' => $this->_path . 'views/img/flags/',
            'loginIcon' => $this->_path . 'views/img/logo-pl.svg',
        ));

        return $output . $this->display(__FILE__, 'login.tpl');
    }

    /**
     * Generates configuration for shipping step in checkout process.
     *
     * @param array $params
     *
     * @return array
     *
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\QueryFilterInvalidParamException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     * @throws \PrestaShopDatabaseException
     * @throws \PrestaShopException
     */
    protected function getShippingStepConfiguration($params)
    {
        \Packlink\PrestaShop\Classes\Bootstrap::init();

        $supportedLanguages = array('en', 'es', 'it', 'fr', 'de');

        $dropOffs = \Packlink\PrestaShop\Classes\Utility\CarrierUtility::getDropOffCarrierReferenceIds();
        $configuration = array(
            'dropoffIds' => $dropOffs,
            'getLocationsUrl' => $this->getFrontAction('locations'),
        );

        $lang = 'en';
        $cart = $params['cart'];
        $language = new \Language((int) $cart->id_lang);

        if (Validate::isLoadedObject($language) && in_array($language->iso_code, $supportedLanguages, true)) {
            $lang = $language->iso_code;
        }

        $configuration['lang'] = $lang;

        /** @var \Cart $cart */
        $cart = $params['cart'];

        if (!empty($dropOffs[(int)$cart->id_carrier])) {
            $repository = \Logeecom\Infrastructure\ORM\RepositoryRegistry::getRepository(
                \Packlink\PrestaShop\Classes\Entities\CartCarrierDropOffMapping::getClassName()
            );

            $query = new \Logeecom\Infrastructure\ORM\QueryFilter\QueryFilter();
            $query->where('cartId', '=', (string)$cart->id)
                ->where('carrierReferenceId', '=', (string)$cart->id_carrier);

            /** @var \Packlink\PrestaShop\Classes\Entities\CartCarrierDropOffMapping $mapping */
            $mapping = $repository->selectOne($query);

            if ($mapping) {
                $configuration['selectedLocation'] = $mapping->getDropOff();
                $configuration['selectedCarrier'] = $mapping->getCarrierReferenceId();
            }
        }

        return $configuration;
    }

    /**
     * Returns additional content that has to be injected in shipping step during checkout in PrestaShop 1.6.
     *
     * @param array $params
     *
     * @return string
     *
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\QueryFilterInvalidParamException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     * @throws \PrestaShopDatabaseException
     * @throws \PrestaShopException
     */
    protected function getPresta16ShippingStepPage($params)
    {
        $configuration = $this->getShippingStepConfiguration($params);

        $this->context->smarty->assign(
            array('configuration' => json_encode($configuration))
        );

        $shippingServicePath = $this->_path . 'views/js/ShippingService16.js?v=' . $this->version;
        $output = "<script src=\"{$shippingServicePath}\"></script>\n";

        $output .= $this->getCheckoutFilesLinks();

        return $output . $this->display(__FILE__, 'shipping_methods_16.tpl');
    }

    /**
     * Gets the HTML for links for CSS and JS files needed in checkout process.
     *
     * @return string
     */
    protected function getCheckoutFilesLinks()
    {
        $ajaxPath = $this->_path . 'views/js/core/AjaxService.js?v=' . $this->version;
        $output = "<script src=\"{$ajaxPath}\"></script>\n";

        $ajaxPath = $this->_path . 'views/js/PrestaAjaxService.js?v=' . $this->version;
        $output .= "<script src=\"{$ajaxPath}\"></script>\n";

        $stylePath = $this->_path . 'views/css/checkout.css?v=' . $this->version;
        $output .= "<link rel=\"stylesheet\" href=\"{$stylePath}\"/>\n";

        $checkoutPath = $this->_path . 'views/js/CheckOutController.js?v=' . $this->version;
        $output .= "<script src=\"{$checkoutPath}\"></script>\n";

        $mapModalPath = $this->_path . 'views/js/MapModalController.js?v=' . $this->version;
        $output .= "<script src=\"{$mapModalPath}\"></script>\n";

        return $output;
    }

    /**
     * Gets HTML scripts for output template for checkout process.
     *
     * @return string
     */
    protected function getLocationPickerFilesLinks()
    {
        $locationPickerLibrary = $this->_path . 'views/js/location/LocationPicker.js?v=' . $this->version;
        $output = "<script src=\"{$locationPickerLibrary}\"></script>\n";

        $locationPickerTrans = $this->_path . 'views/js/location/Translations.js?v=' . $this->version;
        $output .= "<script src=\"{$locationPickerTrans}\"></script>\n";

        $locationPickerCSS = $this->_path . 'views/css/locationPicker.css?v=' . $this->version;
        $output .= "<link rel=\"stylesheet\" href=\"{$locationPickerCSS}\"/>\n";

        return $output;
    }

    /**
     * Creates drop-off address.
     *
     * @param \Order $order
     *
     * @return bool
     */
    protected function createDropOffAddress(\Order $order)
    {
        try {
            $repository = \Logeecom\Infrastructure\ORM\RepositoryRegistry::getRepository(
                \Packlink\PrestaShop\Classes\Entities\CartCarrierDropOffMapping::getClassName()
            );

            $query = new \Logeecom\Infrastructure\ORM\QueryFilter\QueryFilter();
            $query->where('cartId', '=', (string)$order->id_cart)
                ->where('carrierReferenceId', '=', (string)$order->id_carrier);

            $mapping = $repository->selectOne($query);

            if (!$mapping) {
                \Logeecom\Infrastructure\Logger\Logger::logWarning(
                    "Drop-off is not selected for order [{$order->id}]."
                );

                return false;
            }

            $dropOff = $mapping->getDropOff();
            \Packlink\PrestaShop\Classes\Utility\AddressUitlity::createDropOffAddress($order, $dropOff);
        } catch (\Exception $e) {
            \Logeecom\Infrastructure\Logger\Logger::logError(
                "Failed to created drop-off for order [{$order->id}] becauese: {$e->getMessage()}."
            );

            return false;
        }

        return true;
    }

    /**
     * Checks if Packlink authorization token, default parcel and default warehouse have been set in the shop.
     *
     * @return bool Returns TRUE if module has been fully configured, otherwise returns FALSE.
     */
    private function moduleFullyConfigured()
    {
        /** @var \Packlink\PrestaShop\Classes\BusinessLogicServices\ConfigurationService $configService */
        $configService = \Logeecom\Infrastructure\ServiceRegister::getService(
            \Packlink\BusinessLogic\Configuration::CLASS_NAME
        );

        $authToken = $configService->getAuthorizationToken();
        $defaultParcel = $configService->getDefaultParcel();
        $defaultWarehouse = $configService->getDefaultWarehouse();

        return $authToken && $defaultParcel && $defaultWarehouse;
    }

    /**
     * Checks whether order draft should be created, and if so, enqueues order draft task for creating order draft
     * and storing shipping reference.
     *
     * @param \Order $order PrestaShop order object.
     * @param \OrderState $orderState Order state object.
     *
     * @param bool $isDelayed
     *
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\QueryFilterInvalidParamException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     * @throws \Logeecom\Infrastructure\TaskExecution\Exceptions\QueueStorageUnavailableException
     * @throws \PrestaShopDatabaseException
     * @throws \PrestaShopException
     */
    private function createOrderDraft(\Order $order, OrderState $orderState, $isDelayed = false)
    {
        \Packlink\PrestaShop\Classes\Bootstrap::init();
        /** @var \Packlink\PrestaShop\Classes\Repositories\OrderRepository $orderRepository */
        $orderRepository = \Logeecom\Infrastructure\ServiceRegister::getService(
            \Packlink\BusinessLogic\Order\Interfaces\OrderRepository::CLASS_NAME
        );

        if ($this->draftShouldBeCreated($order, $orderState->id, $orderRepository)) {
            $this->enqueueDraftTask((int)$order->id, $orderRepository, $isDelayed);
        }
    }

    /**
     * Checks whether draft for this order hasn't already been created, whether it has been paid and whether the
     * shipping carrier of that order has been created by Packlink. If all these conditions are satisfied, order draft
     * for the provided order should be created.
     *
     * @param \Order $order PrestaShop order object.
     * @param int $orderStatus Current order status.
     * @param \Packlink\PrestaShop\Classes\Repositories\OrderRepository $orderRepository Order repository.
     *
     * @return bool Returns TRUE if draft should be created, otherwise returns FALSE.
     *
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\QueryFilterInvalidParamException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     * @throws \PrestaShopDatabaseException
     * @throws \PrestaShopException
     */
    private function draftShouldBeCreated(\Order $order, $orderStatus, $orderRepository)
    {
        /** @var \Packlink\PrestaShop\Classes\BusinessLogicServices\CarrierService $carrierService */
        $carrierService = \Logeecom\Infrastructure\ServiceRegister::getService(
            \Packlink\BusinessLogic\ShippingMethod\Interfaces\ShopShippingMethodService::CLASS_NAME
        );
        $carrier = new Carrier((int)$order->id_carrier);
        $orderDetails = $orderRepository->getOrderDetailsById((int)$order->id);
        $carrierServiceMapping = $carrierService->getMappingByCarrierReferenceId((int)$carrier->id_reference);

        return $orderDetails === null
            && $carrierServiceMapping !== null
            && ($orderStatus === self::PRESTASHOP_PAYMENT_ACCEPTED_STATUS
                || $orderStatus === self::PRESTASHOP_PROCESSING_IN_PROGRESS_STATUS);
    }

    /**
     * Enqueues SendDraftTask for creating order draft on Packlink and storing shipment reference.
     *
     * @param int $orderId ID of the order.
     * @param \Packlink\PrestaShop\Classes\Repositories\OrderRepository $orderRepository Order repository.
     *
     * @param bool $isDelayed
     *
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\QueryFilterInvalidParamException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     * @throws \Logeecom\Infrastructure\TaskExecution\Exceptions\QueueStorageUnavailableException
     * @throws \PrestaShopDatabaseException
     * @throws \PrestaShopException
     */
    private function enqueueDraftTask($orderId, $orderRepository, $isDelayed = false)
    {
        /** @var \Packlink\PrestaShop\Classes\BusinessLogicServices\ConfigurationService $configService */
        $configService = \Logeecom\Infrastructure\ServiceRegister::getService(
            \Packlink\BusinessLogic\Configuration::CLASS_NAME
        );
        /** @var \Logeecom\Infrastructure\TaskExecution\QueueService $queue */
        $queue = \Logeecom\Infrastructure\ServiceRegister::getService(
            \Logeecom\Infrastructure\TaskExecution\QueueService::CLASS_NAME
        );

        $orderDetails = new \Packlink\BusinessLogic\Order\Models\OrderShipmentDetails();
        $orderDetails->setOrderId($orderId);
        $orderRepository->saveOrderDetails($orderDetails);

        if ($isDelayed) {
            $this->doEnqueueDelayedSendDraftTask($orderId, $configService);
        } else {
            $this->doEnqueueSendDraftTask($orderId, $orderRepository, $queue, $configService);
        }
    }

    /**
     * Renders configuration page.
     *
     * @return string
     * @throws \PrestaShopException
     */
    private function renderConfigForm()
    {
        /** @var \Packlink\PrestaShop\Classes\BusinessLogicServices\ConfigurationService $configService */
        $configService = \Logeecom\Infrastructure\ServiceRegister::getService(
            \Packlink\BusinessLogic\Configuration::CLASS_NAME
        );
        $userInfo = $configService->getUserInfo();
        $linkLanguage = 'ES';
        $warehouseCountry = '';
        if ($userInfo !== null && array_key_exists($userInfo->country, self::$helpUrls)) {
            $linkLanguage = $userInfo->country;
            $warehouseCountry = \Packlink\PrestaShop\Classes\Utility\TranslationUtility::__(
                self::$countryNames[$userInfo->country]
            );
        }

        $this->context->smarty->assign(
            array(
                'dashboardGetStatusUrl' => $this->getAction('Dashboard', 'getStatus'),
                'defaultParcelGetUrl' => $this->getAction('DefaultParcel', 'getDefaultParcel'),
                'defaultParcelSubmitUrl' => $this->getAction('DefaultParcel', 'submitDefaultParcel'),
                'defaultWarehouseGetUrl' => $this->getAction('DefaultWarehouse', 'getDefaultWarehouse'),
                'defaultWarehouseSubmitUrl' => $this->getAction('DefaultWarehouse', 'submitDefaultWarehouse'),
                'defaultWarehouseSearchPostalCodesUrl' => $this->getAction('DefaultWarehouse', 'searchPostalCodes'),
                'shippingMethodsGetAllUrl' => $this->getAction('ShippingMethods', 'getAll'),
                'shippingMethodsGetStatusUrl' => $this->getAction('ShippingMethods', 'getTaskStatus'),
                'shippingMethodsActivateUrl' => $this->getAction('ShippingMethods', 'activate'),
                'shippingMethodsDeactivateUrl' => $this->getAction('ShippingMethods', 'deactivate'),
                'shippingMethodsSaveUrl' => $this->getAction('ShippingMethods', 'save'),
                'getSystemOrderStatusesUrl' => $this->getAction('OrderStateMapping', 'getSystemOrderStatuses'),
                'orderStatusMappingsGetUrl' => $this->getAction('OrderStateMapping', 'getMappings'),
                'orderStatusMappingsSaveUrl' => $this->getAction('OrderStateMapping', 'saveMappings'),
                'debugGetStatusUrl' => $this->getAction('Debug', 'getStatus'),
                'debugSetStatusUrl' => $this->getAction('Debug', 'setStatus'),
                'getSystemInfoUrl' => $this->getAction('Debug', 'getSystemInfo', false),
                'shopShippingMethodCountGetUrl' => $this->getAction('ShippingMethods', 'getNumberShopMethods'),
                'shopShippingMethodsDisableUrl' => $this->getAction('ShippingMethods', 'disableShopShippingMethods'),
                'shippingMethodsGetTaxClassesUrl' => $this->getAction('ShippingMethods', 'getAvailableTaxClasses'),
                'autoConfigureStartUrl' => $this->getAction('PacklinkAutoConfigure', 'start'),
                'dashboardIcon' => $this->_path . 'views/img/dashboard.png',
                'dashboardLogo' => $this->_path . 'views/img/logo-pl.svg',
                'helpLink' => self::$helpUrls[$linkLanguage],
                'termsAndConditionsLink' => self::$termsAndConditionsUrls[$linkLanguage],
                'pluginVersion' => $this->version,
                'warehouseCountry' => $warehouseCountry,
            )
        );

        $this->context->controller->addCSS(
            array(
                $this->_path . 'views/css/packlink.css?v=' . $this->version,
                $this->_path . 'views/css/bootstrap-prestashop-ui-kit.css?v=' . $this->version,
            ),
            'all',
            null,
            false
        );

        $this->context->controller->addJS(
            array(
                $this->_path . 'views/js/prestashop-ui-kit.js?v=' . $this->version,
                $this->_path . 'views/js/core/StateController.js?v=' . $this->version,
                $this->_path . 'views/js/core/TemplateService.js?v=' . $this->version,
                $this->_path . 'views/js/core/SidebarController.js?v=' . $this->version,
                $this->_path . 'views/js/core/DefaultParcelController.js?v=' . $this->version,
                $this->_path . 'views/js/core/PageControllerFactory.js?v=' . $this->version,
                $this->_path . 'views/js/core/DefaultWarehouseController.js?v=' . $this->version,
                $this->_path . 'views/js/core/ShippingMethodsController.js?v=' . $this->version,
                $this->_path . 'views/js/core/UtilityService.js?v=' . $this->version,
                $this->_path . 'views/js/core/AjaxService.js?v=' . $this->version,
                $this->_path . 'views/js/PrestaAjaxService.js?v=' . $this->version,
                $this->_path . 'views/js/PrestaFix.js?v=' . $this->version,
                $this->_path . 'views/js/core/OrderStateMappingController.js?v=' . $this->version,
                $this->_path . 'views/js/core/FooterController.js?v=' . $this->version,
            ),
            false
        );

        return $this->display(__FILE__, 'packlink.tpl');
    }

    /**
     * Performs login.
     *
     * @return bool
     *
     * @throws \Logeecom\Infrastructure\TaskExecution\Exceptions\QueueStorageUnavailableException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     */
    private function login()
    {
        $apiToken = Tools::getValue('api_key', null);
        /** @var \Packlink\BusinessLogic\User\UserAccountService $userAccountService */
        $userAccountService = \Logeecom\Infrastructure\ServiceRegister::getService(
            \Packlink\BusinessLogic\User\UserAccountService::CLASS_NAME
        );

        return $userAccountService->login($apiToken);
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

    /**
     * Retrieves front action url.
     *
     * @param string $controller
     *
     * @return string
     */
    private function getFrontAction($controller)
    {
        return $this->context->link->getModuleLink(
            'packlink',
            $controller,
            array(),
            null,
            null,
            Context::getContext()->shop->id
        );
    }

    /**
     * @param \Packlink\PrestaShop\Classes\Repositories\OrderRepository $orderRepository
     * @param $orderId
     *
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\QueryFilterInvalidParamException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     * @throws \PrestaShopDatabaseException
     * @throws \PrestaShopException
     */
    private function prepareLabelsTemplate(
        \Packlink\PrestaShop\Classes\Repositories\OrderRepository $orderRepository,
        $orderId
    ) {
        $this->context->controller->addJS(
            $this->_path . 'views/js/PrestaPrintShipmentLabels.js?v=' . $this->version,
            false
        );

        /** @var \Packlink\BusinessLogic\Order\OrderService $orderService */
        $orderService = \Logeecom\Infrastructure\ServiceRegister::getService(
            \Packlink\BusinessLogic\Order\OrderService::CLASS_NAME
        );

        $labels = $orderRepository->getLabelsByOrderId($orderId);
        $orderDetails = $orderRepository->getOrderDetailsById((int)$orderId);
        $status = $orderDetails
            ? $orderDetails->getStatus()
            :
            \Packlink\BusinessLogic\ShippingMethod\Utility\ShipmentStatus::STATUS_PENDING;

        $isLabelPrinted = !empty($labels) && $labels[0]->isPrinted();

        $this->context->smarty->assign(
            array(
                'orderId' => $orderId,
                'isLabelPrinted' => $isLabelPrinted,
                'date' => !empty($labels) ? $labels[0]->getDateCreated()->format('d/m/Y') : '',
                'status' => $isLabelPrinted
                    ? \Packlink\PrestaShop\Classes\Utility\TranslationUtility::__('Printed')
                    : \Packlink\PrestaShop\Classes\Utility\TranslationUtility::__('Ready'),
                'isLabelAvailable' => $orderService->isReadyToFetchShipmentLabels($status),
                'number' => '#PLSL1',
            )
        );
    }

    /**
     * Prepares Packlink shipping tab data based on the state of order details and draft task.
     *
     * @param int $orderId ID of the order.
     *
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\QueryFilterInvalidParamException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     * @throws \PrestaShopDatabaseException
     * @throws \PrestaShopException
     */
    private function prepareShippingTabData($orderId)
    {
        /* @var \Packlink\PrestaShop\Classes\Repositories\OrderRepository $orderRepository */
        $orderRepository = \Logeecom\Infrastructure\ServiceRegister::getService(
            \Packlink\BusinessLogic\Order\Interfaces\OrderRepository::CLASS_NAME
        );
        /** @var \Logeecom\Infrastructure\TaskExecution\QueueService $queue */
        $queue = \Logeecom\Infrastructure\ServiceRegister::getService(
            \Logeecom\Infrastructure\TaskExecution\QueueService::CLASS_NAME
        );
        $orderDetails = $orderRepository->getOrderDetailsById($orderId);

        $shipping = null;
        $message = '';
        $displayDraftButton = false;

        if ($orderDetails === null
            || ($orderDetails->getReference() === null && $orderDetails->getTaskId() === null)
        ) {
            $message = \Packlink\PrestaShop\Classes\Utility\TranslationUtility::__(
                'Create order draft in Packlink PRO'
            );
            $displayDraftButton = true;
        } else {
            $draftTask = $orderDetails->getTaskId() ? $queue->find($orderDetails->getTaskId()) : null;

            if ($draftTask !== null
                && $draftTask->getStatus() === \Logeecom\Infrastructure\TaskExecution\QueueItem::FAILED) {
                $message = \Packlink\PrestaShop\Classes\Utility\TranslationUtility::__(
                    'Previous attempt to create a draft failed. Error: %s',
                    array($draftTask->getFailureDescription())
                );
                $displayDraftButton = true;
            } elseif ($orderDetails->getReference() === null) {
                $message = \Packlink\PrestaShop\Classes\Utility\TranslationUtility::__(
                    'Draft is currently being created in Packlink'
                );
            } else {
                $shipping = $this->prepareShippingObject($orderId, $orderDetails, $orderRepository);
            }
        }

        $printLabelsUrl = $this->context->link->getAdminLink('BulkShipmentLabels');

        $this->context->smarty->assign(array(
            'shipping' => $shipping,
            'message' => $message,
            'printLabelsUrl' => $printLabelsUrl,
            'pluginBasePath' => $this->_path,
            'orderId' => $orderId,
            'displayDraftButton' => $displayDraftButton,
            'createDraftUrl' => $this->context->link->getAdminLink('OrderDraft') . '&' .
                http_build_query(
                    array(
                        'ajax' => true,
                        'action' => 'createOrderDraft',
                    )
                ),
        ));
    }

    /**
     * Prepares shipping details object for Packlink shipping tab.
     *
     * @param int $orderId ID of the order.
     * @param \Packlink\BusinessLogic\Order\Models\OrderShipmentDetails $orderDetails Details of the order.
     * @param \Packlink\PrestaShop\Classes\Repositories\OrderRepository $orderRepository Order repository.
     *
     * @return object
     *
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\QueryFilterInvalidParamException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     * @throws \PrestaShopDatabaseException
     * @throws \PrestaShopException
     */
    private function prepareShippingObject(
        $orderId,
        $orderDetails,
        \Packlink\PrestaShop\Classes\Repositories\OrderRepository $orderRepository
    ) {
        /** @var \Logeecom\Infrastructure\Utility\TimeProvider $timeProvider */
        $timeProvider = \Logeecom\Infrastructure\ServiceRegister::getService(
            \Logeecom\Infrastructure\Utility\TimeProvider::CLASS_NAME
        );

        $order = new \Order($orderId);
        $carrier = new Carrier((int)$order->id_carrier);

        $this->prepareLabelsTemplate($orderRepository, $orderId);

        return (object)array(
            'name' => $carrier->name,
            'reference' => $orderDetails->getReference(),
            'deleted' => $orderDetails->isDeleted(),
            'icon' => file_exists(_PS_SHIP_IMG_DIR_ . '/' . (int)$carrier->id . '.jpg') ?
                __PS_BASE_URI__ . 'img/s/' . (int)$carrier->id . '.jpg' : '',
            'status' => $orderDetails->getShippingStatus() !== null ? $orderDetails->getShippingStatus()
                : '',
            'time' => $orderDetails->getLastStatusUpdateTime() !== null
                ? $timeProvider->serializeDate($orderDetails->getLastStatusUpdateTime(), 'd.m.Y H:i:s')
                : '',
            'carrier_tracking_numbers' => $orderDetails->getCarrierTrackingNumbers(),
            'carrier_tracking_url' => $orderDetails->getCarrierTrackingUrl() !== null
                ? $orderDetails->getCarrierTrackingUrl() : '',
            'packlink_shipping_price' => $orderDetails->getShippingCost() !== null
                ? $orderDetails->getShippingCost() . ' €' : '',
            'link' => $this->getOrderDraftUrl($orderDetails->getReference()),
        );
    }

    /**
     * Returns link to order draft on Packlink for the provided shipment reference.
     *
     * @param string $reference Shipment reference.
     *
     * @return string Link to order draft on Packlink.
     */
    private function getOrderDraftUrl($reference)
    {
        /** @var \Packlink\BusinessLogic\Configuration $configService */
        $configService = \Logeecom\Infrastructure\ServiceRegister::getService(
            \Packlink\BusinessLogic\Configuration::CLASS_NAME
        );
        $userCountry = $configService->getUserInfo() !== null
            ? Tools::strtolower($configService->getUserInfo()->country)
            : 'es';

        return "https://pro.packlink.$userCountry/private/shipments/$reference";
    }

    /**
     * Enqueues SendDraftTask.
     *
     * @param int $orderId
     * @param \Packlink\PrestaShop\Classes\Repositories\OrderRepository $orderRepository
     * @param \Logeecom\Infrastructure\TaskExecution\QueueService $queue
     * @param \Packlink\PrestaShop\Classes\BusinessLogicServices\ConfigurationService $configService
     *
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\QueryFilterInvalidParamException
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     * @throws \Logeecom\Infrastructure\TaskExecution\Exceptions\QueueStorageUnavailableException
     * @throws \PrestaShopDatabaseException
     * @throws \PrestaShopException
     */
    private function doEnqueueSendDraftTask(
        $orderId,
        $orderRepository,
        $queue,
        $configService
    ) {
        $draftTask = new \Packlink\BusinessLogic\Tasks\SendDraftTask($orderId);

        $queue->enqueue($configService->getDefaultQueueName(), $draftTask);
        if ($draftTask->getExecutionId() !== null) {
            // get again from database since it can happen that task already finished and
            // reference has been set, so we don't delete it here.

            /** @var \Packlink\BusinessLogic\Order\Models\OrderShipmentDetails $orderDetails */
            $orderDetails = $orderRepository->getOrderDetailsById($orderId);
            $orderDetails->setTaskId($draftTask->getExecutionId());
            $orderRepository->saveOrderDetails($orderDetails);
        }
    }

    /**
     * Enqueues delayed send draft task.
     *
     * @param int $orderId
     * @param \Packlink\PrestaShop\Classes\BusinessLogicServices\ConfigurationService $configService
     *
     * @throws \Logeecom\Infrastructure\ORM\Exceptions\RepositoryNotRegisteredException
     */
    private function doEnqueueDelayedSendDraftTask(
        $orderId,
        $configService
    ) {
        $task = new \Packlink\PrestaShop\Classes\Tasks\DelayedSendDraftTaskEnqueuerTask($orderId);
        $timestamp = strtotime('+5 minutes');
        $schedule = new \Packlink\BusinessLogic\Scheduler\Models\HourlySchedule(
            $task,
            $configService->getDefaultQueueName()
        );

        $schedule->setMonth((int)date('m', $timestamp));
        $schedule->setDay((int)date('d', $timestamp));
        $schedule->setHour((int)date('H', $timestamp));
        $schedule->setMinute((int)date('i', $timestamp));
        $schedule->setRecurring(false);
        $schedule->setNextSchedule();

        $repository = \Logeecom\Infrastructure\ORM\RepositoryRegistry::getRepository(
            \Packlink\BusinessLogic\Scheduler\Models\Schedule::CLASS_NAME
        );

        $repository->save($schedule);
    }
}
