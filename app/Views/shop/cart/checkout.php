<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/30/2016
 * Time: 4:15 PM
 */


$assets = $view['assets'];

/** @var $cart Models\Cart */
/** @var $order Models\Order */
/** @var $store Models\Store */

?>
<section id="cart_items">
    <div class="container">
<p>You are now been directed to My eStores to complete your order. Please wait</p>

<form action="http://www.myestores.com.ng/checkout/checkout" method="post" id="checkout_form">
    <input type="hidden" value="<?=$store->getMerchantId()?>" name="merchant_id">
    <input type="hidden" value="<?=$store->getId()?>" name="store_id">
    <input type="hidden" value="<?=$order->getId()?>" name="merchant_order_id">


    <?php
    $i = 0;
    foreach($cart->getItems() as $item):
    /** @var Models\cartItem $item */
    $product = $item->getProduct();
    /** @var Models\Product $product */
    ?>
        <input type="hidden" value="<?= \Globals\Utility::getInstance()->getCurrentUrl(). $assets->getUrl($product->getFileFullName()) ?>" name="items[<?=$i?>][image_src]">
        <input type="hidden" name="items[<?=$i?>][weight]" value="<?= $product->getWeight()?>">
        <input type="hidden" value="<?= $product->getName() ?>" name="items[<?=$i?>][name]">
        <input type="hidden" value="<?= $item->getColour() ?>" name="items[<?=$i?>][colour]">
        <input type="hidden" value="<?= $item->getSize() ?>" name="items[<?=$i?>][size]">
        <input type="hidden" value="<?= $product->getId() ?>" name="items[<?=$i?>][web_id]">
        <input type="hidden" value="<?= $product->getNewPrice() ?>" name="items[<?=$i?>][price]">
        <input type="hidden" value="<?= $item->getQuantity() ?>" name="items[<?=$i?>][quantity]">
        <input type="hidden" value="<?= $item->getTotal() ?>" name="items[<?=$i?>][total]">

        <?php $i++; endforeach;?>



    <input type="submit" value="Continue">
</form>

<script>
    document.getElementById("checkout_form").submit();
</script>

        </div>
    </section>
