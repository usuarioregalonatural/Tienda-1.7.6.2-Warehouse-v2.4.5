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

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * Upgrades module to version 2.0.4.
 *
 * @param \Packlink $module
 *
 * @return bool
 *
 * @throws \PrestaShopException
 */
function upgrade_module_2_0_4($module)
{
    $previousShopContext = \Shop::getContext();
    \Shop::setContext(\Shop::CONTEXT_ALL);

    \Packlink\PrestaShop\Classes\Bootstrap::init();

    // Remove libraries used in previous module version
    $path = _PS_MODULE_DIR_ . $module->name . '/vendor/';
    \Tools::deleteDirectory($path . 'ircmaxell');
    \Tools::deleteDirectory($path . 'symfony');
    \Tools::deleteDirectory($path . 'zendframework');
    \Tools::deleteFile($path . 'composer/autoload_files.php');

    $module->enable();

    \Shop::setContext($previousShopContext);

    return true;
}
