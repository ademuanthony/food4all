<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/8/2016
 * Time: 1:16 PM
 */

use Globals\Utility;
use Globals\AppService;
use Framework\TinyMvc;

$assets = $view['assets'];

/** @var $cart Models\Cart */
/** @var $store Models\Store */
?>


<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
    <div class="container">
        <div class="row">
            <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Shopping Cart</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?= \Framework\TinyMvc::toRoute(\Globals\AppService::RouteBackendDashboard) ?>">Dashboard</a></li>
                    <li><a href="<?= \Framework\TinyMvc::toRoute(\Globals\AppService::Shop) ?>">Shop</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs end-->


<form action="<?=TinyMvc::toRoute(AppService::RouteCheckout)?>" method="post">
    <input type="hidden" value="<?=$store->getMerchantId()?>" name="merchant_id">
    <input type="hidden" value="<?=$store->getId()?>" name="store_id">

    <section class="section" id="cart_items">
        <div class="row">
            <div class="col s12">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu rastvor-config-button">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 0;
                    foreach($cart->getItems() as $item):
                        /** @var Models\cartItem $item */
                        $product = $item->getProduct();
                        /** @var Models\Product $product */
                        ?>

                        <tr>
                            <td style="width: 150px;" class="cart_product">
                                <a href="<?=TinyMvc::toRoute(AppService::RouteFrontendViewProduct, ['permalink' => $product->getPermalink()])?>">
                                    <img style="max-width: 140px;" src="<?= $assets->getUrl($product->getFileFullName()) ?>" alt="">
                                    <input type="hidden" value="<?= Utility::getInstance()->getCurrentUrl(). $assets->getUrl($product->getFileFullName()) ?>" name="items[<?=$i?>][image_src]">
                                    <input type="hidden" name="items[<?=$i?>][weight]" value="<?= $product->getWeight()?>">
                                </a>
                            </td>
                            <td class="cart_description">
                                <input type="hidden" value="<?= $product->getName() ?>" name="items[<?=$i?>][name]">
                                <h4><a href=""><?= $product->getName()?></a></h4>
                                <input type="hidden" value="<?= $product->getId() ?>" name="items[<?=$i?>][web_id]">
                                <p>Web ID: <?= $product->getId()?></p>
                            </td>
                            <td class="cart_price">
                                <input type="hidden" value="<?= $product->getNewPrice() ?>" name="items[<?=$i?>][price]">
                                <p>N<?= $product->getNewPrice()?></p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_down" href="<?= TinyMvc::toRoute(AppService::RouteReduceCartItem, ['product_id' => $product->getId(), 'qnt' => 1])?>"> - </a>
                                    <input class="cart_quantity_input" type="text" name="quantity" value="<?= $item->getQuantity()?>" autocomplete="off" size="2">
                                    <input type="hidden" value="<?= $item->getQuantity() ?>" name="items[<?=$i?>][quantity]">
                                    <a class="cart_quantity_up" href="<?= TinyMvc::toRoute(AppService::RouteIncreaseCartItem, ['product_id' => $product->getId(), 'qnt' => 1])?>"> + </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price rastvor-config-text">N<?= $item->getTotal() ?></p>
                                <input type="hidden" value="<?= $item->getTotal() ?>" name="items[<?=$i?>][total]">
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="<?= TinyMvc::toRoute(AppService::RouteRemoveFromCart, ['product_id' => $item->getProductId()]) ?>"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>

                    <?php $i++; endforeach;?>

                    </tbody>

                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->




    <section class="section" id="do_action">
        <div class="row">
            <div class="heading">
                <h3>Total Cost Summary?</h3>
            </div>
            <div class="row">

                <div class="col s6">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <span>N<?=$cart->getTotal()?></span></li>
                            <li>Shipping Cost <span>To be calculated</span></li>
                            <li>Total <span>N<?=$cart->getTotal()?></span></li>
                        </ul>
                        <button type="button" onclick="history.back()" class="btn btn-default update rastvor-config-button" href="">Continue Shopping</button>
                        <button type="submit" class="btn btn-default check_out rastvor-config-button" href="">Buy Food</button>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->

</form>



