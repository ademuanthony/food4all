<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 12/12/2016
 * Time: 10:15 AM
 */

use Framework\TinyMvc;
use Globals\AppService;
?>

<style>
    .product{
        margin-bottom: 10px;
    }
</style>

<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
    <div class="container">
        <div class="row">
            <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Shop</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?= \Framework\TinyMvc::toRoute(\Globals\AppService::RouteBackendDashboard) ?>">Dashboard</a></li>
                    <li class="active">Buy Food</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs end-->


<section class="section">
    <div class="row">
        <?php foreach($page_info->data as $product): /** @var $product \Models\Product */ ?>
        <div class="product col s12 m4 l3">
            <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <a href="<?= TinyMvc::toRoute(AppService::RouteFrontendViewProduct, ['permalink' => $product->getPermalink()]) ?>" class="btn-floating btn-large btn-price waves-effect waves-light  pink accent-2">$<?= $product->getNewPrice() ?></a>


                    <a class="activator">

                        <img src="<?= $view['assets']->getUrl($product->getFileFullName()) ?>" alt="product-img">
                    </a>
                </div>
                <ul class="card-action-buttons">
                    <li>
                        <a title="Add to cart" href="<?= TinyMvc::toRoute(AppService::RouteAddToCart, ['product_id' => $product->getId(), 'qnt' => 1]) ?>"
                           class="btn-floating waves-effect waves-light red accent-2"><i class="mdi-action-favorite"></i></a>
                    </li>
                    <li><a class="btn-floating waves-effect waves-light light-blue"><i class="mdi-action-info activator"></i></a>
                    </li>
                </ul>
                <div class="card-content">

                    <div class="row">
                        <div class="col s8">
                            <p class="card-title grey-text text-darken-4">
                                <a href="<?= TinyMvc::toRoute(AppService::RouteFrontendViewProduct, ['permalink' => $product->getPermalink()]) ?>" class="grey-text text-darken-4"><?= $product->getName() ?></a>
                            </p>
                        </div>
                        <div class="col s4 no-padding">
                            <a href="<?= TinyMvc::toRoute(AppService::RouteFrontendViewProduct, ['permalink' => $product->getPermalink()]) ?>"></a><img src="<?= $view['assets']->getUrl('materialize/images/amazon.jpg')?>" alt="amazon" class="responsive-img">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4"><i class="mdi-navigation-close right"></i> <?= $product->getName() ?></span>
                    <p><?= $product->getDescription() ?>.</p>
                </div>
            </div>
        </div>

        <?php endforeach; ?>



    </div>
</section>
