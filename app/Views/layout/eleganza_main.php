<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/3/2016
 * Time: 11:01 PM
 */

use \Globals\AppService;
use Framework\TinyMvc;
use Globals\Utility;

$theme = 'eleganza';
$currentStoreName = \Globals\Utility::getInstance()->getStore()->getName();
/** @var \Models\Store $store */
/** @var $view array */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= (isset($title)? "$title - ":'').$store->getName()?></title>

    <link href="<?= $view['assets']->getUrl("themes/eleganza/css/bootstrap.min.css")?>" rel="stylesheet">
    <link href="<?= $view['assets']->getUrl("themes/eleganza/css/font-awesome.min.css")?>" rel="stylesheet">
    <link href="<?= $view['assets']->getUrl("themes/eleganza/css/prettyPhoto.css")?>" rel="stylesheet">
    <link href="<?= $view['assets']->getUrl("themes/eleganza/css/price-range.css")?>" rel="stylesheet">
    <link href="<?= $view['assets']->getUrl("themes/eleganza/css/animate.css")?>" rel="stylesheet">
    <link href="<?= $view['assets']->getUrl("themes/eleganza/css/main.css")?>" rel="stylesheet">
    <link href="<?= $view['assets']->getUrl("themes/eleganza/css/responsive.css")?>" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?= $view['assets']->getUrl("stores/$currentStoreName/themes/$theme/css/rastvorConfig.css")?>">

    <!--[if lt IE 9]>
    <script src="<?= $view['assets']->getUrl("themes/eleganza/js/html5shiv.js")?>"></script>
    <script src="<?= $view['assets']->getUrl("themes/eleganza/js/respond.min.js")?>"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?= $view['assets']->getUrl("themes/eleganza/images/ico/favicon.ico")?>">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= $view['assets']->getUrl("themes/eleganza/images/ico/apple-touch-icon-144-precomposed.png")?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= $view['assets']->getUrl("themes/eleganza/images/ico/apple-touch-icon-114-precomposed.png")?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= $view['assets']->getUrl("themes/eleganza/images/ico/apple-touch-icon-72-precomposed.png")?>">
    <link rel="apple-touch-icon-precomposed" href="<?= $view['assets']->getUrl("themes/eleganza/images/ico/apple-touch-icon-57-precomposed.png")?>">

</head><!--/head-->

<body>

<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone rastvor-config-text"></i> <?=$store->getPhoneNumber()?></a></li>
                            <li><a href="#"><i class="fa fa-envelope rastvor-config-text"></i> <?= $store->getEmail()?></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle rastvor-config-header"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="<?= TinyMvc::toRoute(AppService::RouteHome) ?>"><img src="<?=$view['assets']->getUrl($store->getLogoFullPath())?>" alt="" /></a>
                    </div>
                    <div class="btn-group pull-right">
                        <!-- <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa rastvor-config-text" data-toggle="dropdown">
                                NIGERIA
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#" class="rastvor-config-text">Canada</a></li>
                                <li><a href="#" class="rastvor-config-text">USA</a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a style="background-color: transparent !important;" href="#"><i class="fa fa-user rastvor-config-text"></i> Account</a></li>
                            <li><a style="background-color: transparent !important;" href="<?=TinyMvc::toRoute(AppService::RouteCart)?>"><i class="fa fa-shopping-cart rastvor-config-text"></i> Cart</a></li>
                            <li><a style="background-color: transparent !important;" href="login.php"><i class="fa fa-lock rastvor-config-text"></i> Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only rastvor-config-text">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li>
                                <a href="<?= TinyMvc::toRoute(AppService::RouteHome)?>" class="<?=Utility::isActiveMenu(AppService::RouteHome)?'active':''?> rastvor-config-text">Home</a>
                            </li>
                            <li>
                                <a href="<?= TinyMvc::toRoute(AppService::RouteFrontendProducts)?>" class="<?=Utility::isActiveMenu(AppService::RouteFrontendProducts)?'active':''?> rastvor-config-text">Products</a>
                            </li>
                            <li>
                                <a href="<?= TinyMvc::toRoute(AppService::RouteFrontendContact)?>" class="<?=Utility::isActiveMenu(AppService::RouteFrontendContact)?'active':''?> rastvor-config-text">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Search"/>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->


<?= $content ?>



<footer id="footer" class="rastvor-config-footer"><!--Footer-->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="companyinfo">
                        <h2><?=$store->getName()?></h2>
                        <p><?=$store->getShortAboutTest()?></p>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="col-sm-3">

                    </div>

                    <div class="col-sm-3">

                    </div>

                    <div class="col-sm-3">

                    </div>

                    <div class="col-sm-3">

                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="address">
                        <img src="<?= $view['assets']->getUrl("themes/eleganza/images/home/map.png")?>" alt="" />
                        <p class="rastvor-config-text"><?=$store->getAddress()?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-widget rastvor-config-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2 class="rastvor-config-text">Services</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#" class="rastvor-config-text">Contact Us</a></li>
                            <li><a href="#" class="rastvor-config-text">FAQ’s</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2 class="rastvor-config-text">Trending Goods</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#" class="rastvor-config-text">PSP</a></li>
                            <li><a href="#" class="rastvor-config-text">Samsung Galaxy Note</a></li>
                            <li><a href="#" class="rastvor-config-text">Apple Ipad10</a></li>
                            <li><a href="#" class="rastvor-config-text">Lenovo</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2 class="rastvor-config-text">Policies</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#" class="rastvor-config-text">Terms of Use</a></li>
                            <li><a href="#" class="rastvor-config-text">Privacy Policy</a></li>
                            <li><a href="#" class="rastvor-config-text">Refund Policy</a></li>
                            <li><a href="#" class="rastvor-config-text">Support</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2 class="rastvor-config-text">Categories</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <?php $count = 0; foreach ($categories as $category): /** @var \Models\category $category */?>
                            <li><a href="<?=\Framework\TinyMvc::toRoute(AppService::RouteFrontendViewCategory, ['permalink' => $category->getPermalink()])?>" class="rastvor-config-text"><?= $category->getName()?></a></li>
                            <?php if(++$count>5)break; endforeach;?>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-sm-offset-1">
                    <div class="single-widget">
                        <h2 class="rastvor-config-text">Newsletter</h2>
                        <form action="#" class="searchform">
                            <input type="text" placeholder="Your email address" />
                            <button type="submit" class="btn btn-default rastvor-config-button"><i class="fa fa-arrow-circle-o-right"></i></button>
                            <p class="rastvor-config-text">Get the best deals from <br />our site, keep yourself updated...</p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © <?= date("Y"); ?> <?= $store->getName() ?>. All rights reserved.</p>
                <p class="pull-right">Crafted by <span><a  class="rastvor-config-text" target="_blank" href="http://www.myestores.com.ng">MyeStores</a></span></p>
            </div>
        </div>
    </div>

</footer><!--/Footer-->



<script src="<?= $view['assets']->getUrl("themes/eleganza/js/jquery.js")?>"></script>
<script src="<?= $view['assets']->getUrl("themes/eleganza/js/bootstrap.min.js")?>"></script>
<script src="<?= $view['assets']->getUrl("themes/eleganza/js/jquery.scrollUp.min.js")?>"></script>
<script src="<?= $view['assets']->getUrl("themes/eleganza/js/price-range.js")?>"></script>
<script src="<?= $view['assets']->getUrl("themes/eleganza/js/jquery.prettyPhoto.js")?>"></script>
<script src="<?= $view['assets']->getUrl("themes/eleganza/js/main.js")?>"></script>


</body>
</html>