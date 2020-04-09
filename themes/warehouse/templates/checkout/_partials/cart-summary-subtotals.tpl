{**
 * 2007-2017 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2017 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}


<div class="card-block cart-summary-subtotals-container">

    {foreach from=$cart.subtotals item="subtotal"}
        {if $subtotal && $subtotal.type !== 'tax'}
            <div class="cart-summary-line cart-summary-subtotals" id="cart-subtotal-{$subtotal.type}">
                <span class="label">{$subtotal.label}</span>
                {if $subtotal.type === 'discount'}
                    <span class="value">-{$subtotal.value}</span>
                {else}
                    <span class="value">{$subtotal.value}</span>
                {/if}
            </div>
        {/if}
    {/foreach}

</div>
