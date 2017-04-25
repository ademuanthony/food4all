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
                <h5 class="breadcrumbs-title">Promotion Tools</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?= \Framework\TinyMvc::toRoute(\Globals\AppService::RouteBackendDashboard) ?>">Dashboard</a></li>
                    <li class="active">Promotions</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs end-->


<section class="section">
    <div class="row">
        <?php foreach($page_info->data as $campaign): /** @var $campaign \Models\Campaign */ ?>

            <div class="product col s12 m4 l3">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <a href="#" class="btn-floating btn-large btn-price waves-effect waves-light  pink accent-2">Tool</a>


                        <a href="#">

                            <img src="<?= $view['assets']->getUrl($campaign->getFileFullName())?>" alt="product-img">
                        </a>
                    </div>
                    <ul class="card-action-buttons">
                        <li><a href="<?= TinyMvc::toRoute(AppService::FrontendCampaignsShare, ['campaign_id' => $campaign->getId(),
                                'network' => \Globals\AppConstants::FACEBOOK]) ?>" title="Facebook" class="btn-floating waves-effect waves-light light-blue accent-4"><i class="mdi-social-share"></i></a>
                        </li>
                        <li><a title="Twitter" class="btn-floating waves-effect waves-light red accent-2"><i class="mdi-social-share"></i></a>
                        </li>
                        <li><a  title="Google Plus" class="btn-floating waves-effect waves-light red accent-2"><i class="mdi-social-plus-one"></i></a>
                        </li>
                        <li><a class="btn-floating waves-effect waves-light light-blue"><i class="mdi-action-info activator"></i></a>
                        </li>
                    </ul>
                    <div class="card-content">

                        <div class="row">
                            <div class="col s8">
                                <p class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4"><?= $campaign->getTitle() ?></a>
                                </p>
                            </div>
                            <div class="col s4 no-padding">
                                <a href="#"></a>
                                <!--<img src="<?/*= $view['assets']->getUrl('materialize/images/amazon.jpg')*/?>" alt="amazon" class="responsive-img">-->
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-reveal" style="overflow: auto;">
                        <span class="card-title grey-text text-darken-4"><i class="mdi-navigation-close right"></i> <?= $campaign->getTitle() ?></span>
                        <p><?= $campaign->getContent() ?>
                        </p>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>




    </div>
</section>
