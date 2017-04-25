<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 12/2/2016
 * Time: 9:33 PM
 */

use Framework\TinyMvc;
use Helpers\Html;
use Globals\Utility;
use Globals\AppService;

/** @var $content string */
/** @var $view */
/** @var $member \Models\Member */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Food for all nations ">
    <meta name="keywords" content="food for all nation,">
    <title><?= Html::encode((isset($title)?$title.' - ':'').TinyMvc::$config['AppTitle']) ?></title>

    <!-- Favicons-->
    <link rel="icon" href="<?= $view['assets']->getUrl('app/images/logo.png') ?>" sizes="32x32">
    <!-- Favicons-->

    <link rel="apple-touch-icon-precomposed" href="<?= $view['assets']->getUrl('materialize/images/favicon/apple-touch-icon-152x152.png') ?>">
    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="<?= $view['assets']->getUrl('materialize/images/favicon/mstile-144x144.png')?>">
    <!-- For Windows Phone -->


    <!-- CORE CSS-->
    <link href="<?= $view['assets']->getUrl('materialize/css/materialize.min.css')?>" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?= $view['assets']->getUrl('materialize/css/style.min.css')?>" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->
    <link href="<?= $view['assets']->getUrl('materialize/css/custom/custom.min.css')?>" type="text/css" rel="stylesheet" media="screen,projection">

    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="<?= $view['assets']->getUrl('materialize/js/plugins/prism/prism.css')?>" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?= $view['assets']->getUrl('materialize/js/plugins/perfect-scrollbar/perfect-scrollbar.css')?>" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?= $view['assets']->getUrl('materialize/js/plugins/chartist-js/chartist.min.css')?>" type="text/css" rel="stylesheet" media="screen,projection">

    <?php foreach ($c_styles as $style):?>
        <link href="<?php echo $view['assets']->getUrl($style) ?>" rel="stylesheet">
    <?php endforeach?>


    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '380555615627881',
                xfbml      : true,
                version    : 'v2.8'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

</head>

<body>
<!-- Start Page Loading -->
<div id="loader-wrapper">
    <div id="loader"><img src="<?= $view['assets']->getUrl('app/images/logo.png') ?>" style="width: 120px; margin: auto !important;" /></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<!-- End Page Loading -->

<!-- //////////////////////////////////////////////////////////////////////////// -->

<!-- START HEADER -->
<header id="header" class="page-topbar">
    <!-- start header nav-->
    <div class="navbar-fixed">
        <nav class="navbar-color">
            <div class="nav-wrapper">
                <ul class="left">
                    <li>
                        <h1 class="logo-wrapper">
                            <a href="<?= TinyMvc::toRoute(AppService::RouteBackendDashboard) ?>" class="brand-logo darken-1">
                                <!--<img src="<?/*= $view['assets']->getUrl('materialize/images/materialize-logo.png')*/?>" alt="materialize logo">-->
                                Food4All
                            </a> <span class="logo-text">Food4All</span></h1>
                    </li>
                </ul>
                <div class="header-search-wrapper hide-on-med-and-down">
                   <form action="<?= TinyMvc::toRoute(AppService::GenealogySearch) ?>">
                       <i class="mdi-action-search"></i>
                       <input type="text" name="membership_id" class="header-search-input z-depth-2" placeholder="Search downlines"/>
                   </form>
                </div>
                <ul class="right hide-on-med-and-down">
                    <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light translation-button"  data-activates="translation-dropdown"><img src="<?= $view['assets']->getUrl('materialize/images/flag-icons/United-States.png')?>" alt="USA" /></a>
                    </li>
                    <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a>
                    </li>
                    <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light notification-button" data-activates="notifications-dropdown"><i class="mdi-social-notifications"><small class="notification-badge"><?= count($notifications) ?></small></i>

                        </a>
                    </li>
                </ul>
                <!-- translation-button -->
                <ul id="translation-dropdown" class="dropdown-content">
                    <li>
                        <a href="#!"><img src="<?= $view['assets']->getUrl('materialize/images/flag-icons/United-States.png')?>" alt="English" />  <span class="language-select">English</span></a>
                    </li>
                    <li>
                        <a href="#!"><img src="<?= $view['assets']->getUrl('materialize/images/flag-icons/France.png')?>" alt="French" />  <span class="language-select">French</span></a>
                    </li>

                </ul>
                <!-- notifications-dropdown -->
                <ul id="notifications-dropdown" class="dropdown-content">
                    <li>
                        <h5>NOTIFICATIONS <span class="new badge"><?= count($notifications)?></span></h5>
                    </li>
                    <li class="divider"></li>
                    <?php /** @var \Models\Notification $notification */
                    foreach ($notifications as $notification) :?>
                        <li>
                            <a href="<?= TinyMvc::toRoute(AppService::ReadNotification, ['id' => $notification->getId()])?>">
                                <i class="mdi-action-info-outline"></i> <?= $notification->getMessage()?></a>
                            <time class="media-meta" datetime="<?= $notification->getDate() ?>"><?= $notification->getDate() ?></time>
                        </li>

                    <?php endforeach;?>

                </ul>
            </div>
        </nav>
    </div>
    <!-- end header nav-->
</header>
<!-- END HEADER -->

<!-- //////////////////////////////////////////////////////////////////////////// -->

<!-- START MAIN -->
<div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">

        <!-- START LEFT SIDEBAR NAV-->
        <aside id="left-sidebar-nav">
            <ul id="slide-out" class="side-nav fixed leftside-navigation">
                <li class="user-details green darken-2">
                    <div class="row">
                        <div class="col col s4 m4 l4">
                            <img src="<?= empty($member->getProfileImage())?
                                '/web/themes/food/images/empty-member.png': $view['assets']->getUrl('uploads/profile/'.$member->getProfileImage())?>" alt="" class="circle responsive-img valign profile-image">
                        </div>
                        <div class="col col s8 m8 l8">
                            <ul id="profile-dropdown" class="dropdown-content">
                                <li><a href="<?= TinyMvc::toRoute(AppService::Profile) ?>"><i class="mdi-action-face-unlock"></i> Profile</a>
                                </li>
                                <li><a href="<?= TinyMvc::toRoute(AppService::Logout) ?>"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                                </li>
                            </ul>
                            <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?= $member->getFirstname() ?><i class="mdi-navigation-arrow-drop-down right"></i></a>
                            <p class="user-roal"><?= \Models\MatrixStage::getStageName($member->getStage()) ?></p>
                        </div>
                    </div>
                </li>

                <li class="bold <?= (Utility::isActiveMenu(AppService::RouteBackendDashboard)?'active':''); ?>"><a href="<?= TinyMvc::toRoute(AppService::RouteBackendDashboard)?>" class="waves-effect waves-green">
                        <i class="mdi-action-dashboard"></i> Dashboard</a>
                </li>

                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li class="bold">
                            <a class="collapsible-header waves-effect waves-green <?= ((isset($currentMenu) && $currentMenu == AppService::Genealogy)?'active':''); ?>">
                                <i class="mdi-editor-format-line-spacing"></i> Genealogy</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li class="<?= (Utility::isActiveMenu(AppService::Genealogy)?'active':''); ?>">
                                        <a class="waves-effect waves-green" href="<?= TinyMvc::toRoute(AppService::Genealogy) ?>">
                                            My Genealogy
                                        </a>
                                    </li>
                                    <li class="<?= (Utility::isActiveMenu(AppService::Genealogy_Direct_Down_Line)?'active':''); ?>">
                                        <a class="waves-effect waves-green" href="<?= TinyMvc::toRoute(AppService::Genealogy_Direct_Down_Line) ?>">
                                            Direct Downlines
                                        </a>
                                    </li>
                                    <li class="<?= (Utility::isActiveMenu(AppService::Genealogy_My_Down_Line_tree)?'active':''); ?>">
                                        <a class="waves-effect waves-green" href="<?= TinyMvc::toRoute(AppService::Genealogy_My_Down_Line_tree) ?>">
                                            Downline Tree
                                        </a>
                                    </li>
                                    <li class="<?= (Utility::isActiveMenu(AppService::Genealogy_My_Down_Line_List)?'active':''); ?>">
                                        <a class="waves-effect waves-green" href="<?= TinyMvc::toRoute(AppService::Genealogy_My_Down_Line_List) ?>">
                                            Downline List
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>

                <li class="bold <?= (Utility::isActiveMenu(AppService::Earnings) || (isset($currentMenu) && $currentMenu == AppService::Earnings)?'active':''); ?>">
                        <a class="waves-effect waves-green" href="<?= TinyMvc::toRoute(AppService::Earnings) ?>"> <i class="mdi-editor-attach-money"></i> Earnings </a>
                    </li>


                <li class="bold <?= (Utility::isActiveMenu(AppService::Profile) || (isset($currentMenu) && $currentMenu == AppService::Profile)?'active':''); ?>">
                        <a class="waves-effect waves-green" href="<?= TinyMvc::toRoute(AppService::Profile) ?>"> <i class="mdi-social-person"></i> My Account </a>
                    </li>

                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li class="bold">
                            <a class="collapsible-header waves-effect waves-green <?= ((isset($currentMenu) && $currentMenu == AppService::Shop)?'active':''); ?>"> <i class="mdi-action-shopping-cart"></i> Shop <i class="fa arrow"></i> </a>
                            <div class="collapsible-body">
                                <ul>
                                    <li class="<?= (Utility::isActiveMenu(AppService::Pin)?'active':''); ?>">
                                        <a class="waves-effect waves-green" href="<?= TinyMvc::toRoute(AppService::Pin) ?>">
                                            Buy Pin
                                        </a>
                                    </li>
                                    <li class="<?= (Utility::isActiveMenu(AppService::BuyFood)?'active':''); ?>">
                                        <a class="waves-effect waves-green" href="<?= TinyMvc::toRoute(AppService::BuyFood) ?>">
                                            Buy Food
                                        </a>
                                    </li>
                                    <li class="<?= (Utility::isActiveMenu(AppService::RouteCart)?'active':''); ?>">
                                        <a class="waves-effect waves-green" href="<?= TinyMvc::toRoute(AppService::RouteCart) ?>">
                                            Shopping Cart
                                        </a>
                                    </li>
                                    <li class="<?= (Utility::isActiveMenu(AppService::RouteBackendAddCategory)?'active':''); ?>">
                                        <a class="waves-effect waves-green" href="<?= TinyMvc::toRoute(AppService::RouteBackendAddCategory) ?>">
                                            My Orders
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>

                </li>

                <li class="bold <?= (Utility::isActiveMenu(AppService::FundTransfers)?'active':''); ?>">
                    <a class="waves-effect waves-green" href="<?= TinyMvc::toRoute(AppService::FundTransfers) ?>">
                        <i class="mdi-action-shopping-basket"></i> Fund Transfer
                    </a>
                </li>

                <li class="bold <?= (Utility::isActiveMenu(AppService::FrontendCampaigns) || (isset($currentMenu) && $currentMenu == AppService::FrontendCampaigns)?'active':''); ?>">
                    <a class="waves-effect waves-green" href="<?= TinyMvc::toRoute(AppService::FrontendCampaigns) ?>">
                        <i class="mdi-action-wallet-giftcard"></i> Promotion Tools </a>
                </li>
                <?php
                if(Utility::getInstance()->isUserInRole(\Models\Role::Admin)):
                        ?>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li class="bold">
                                <a class="collapsible-header waves-effect waves-green <?= ((isset($currentMenu) && $currentMenu == AppService::RouteBackendCategories)?'active open':''); ?>"> <i class="mdi-action-view-list"></i> Categories <i class="fa arrow"></i> </a>
                                <div class="collapsible-body">
                                    <ul>
                                    <li class="bold <?= (Utility::isActiveMenu(AppService::RouteBackendCategories)?'active':''); ?>">
                                        <a class="waves-effect waves-green" href="<?= TinyMvc::toRoute(AppService::RouteBackendCategories) ?>">
                                            Categories List
                                        </a>
                                    </li>
                                    <li class="bold <?= (Utility::isActiveMenu(AppService::RouteBackendAddCategory)?'active':''); ?>">
                                        <a class="waves-effect waves-green" href="<?= TinyMvc::toRoute(AppService::RouteBackendAddCategory) ?>">
                                            Create Category
                                        </a>
                                    </li>
                                </ul>
                                </div>
                            </li>
                        </ul>

                        </li>

                    <li class="no-padding <?= ((isset($currentMenu) && $currentMenu == AppService::RouteBackendProducts)?'active open':''); ?>">
                        <ul class="collapsible collapsible-accordion">
                            <li class="bold">
                                <a class="collapsible-header waves-effect waves-green <?= ((isset($currentMenu) && $currentMenu == AppService::RouteBackendProducts)?'active':''); ?>"> <i class="mdi-action-view-quilt"></i> Products <i class="fa arrow"></i> </a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li class="bold <?= (Utility::isActiveMenu(AppService::RouteBackendProducts)?'active':''); ?>">
                                            <a class="waves-effect waves-green" href="<?= TinyMvc::toRoute(AppService::RouteBackendProducts) ?>">
                                                Products List
                                            </a> </li>
                                        <li class="bold <?= (Utility::isActiveMenu(AppService::RouteBackendAddProduct)?'active':''); ?>">
                                            <a class="waves-effect waves-green" href="<?= TinyMvc::toRoute(AppService::RouteBackendAddProduct) ?>">
                                                Create Product
                                            </a> </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <li class="bold <?= (Utility::isActiveMenu(AppService:: BackendCampaigns) || (isset($currentMenu) && $currentMenu == AppService::RouteBackendOrders)?'active':''); ?>">
                        <a class="waves-effect waves-green" href="<?= TinyMvc::toRoute(AppService::BackendCampaigns) ?>">
                            <i class="mdi-action-wallet-giftcard"></i> Campaigns Setup </a>
                    </li>

                    <li class="bold <?= (Utility::isActiveMenu(AppService::RouteBackendOrders) || (isset($currentMenu) && $currentMenu == AppService::RouteBackendOrders)?'active':''); ?>">
                        <a class="waves-effect waves-green" href="<?= TinyMvc::toRoute(AppService::RouteBackendOrders) ?>"> <i class="mdi-action-wallet-giftcard"></i> Orders </a>
                    </li>

                    <?php endif;?>


            </ul>
            <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only green"><i class="mdi-navigation-menu"></i></a>
        </aside>
        <!-- END LEFT SIDEBAR NAV-->

        <!-- //////////////////////////////////////////////////////////////////////////// -->

        <!-- START CONTENT -->
        <section id="content" style="min-height: 528px;">
            <?php
            if (!session_id()) @session_start();
            $flashMessage = new \Helpers\MaterializeFlashMessage();
            if($flashMessage->hasMessages()):?>
            <section class="section">
                <div class="row">
                    <div class="col s12">
                        <?php
                        $flashMessage->display();
                        ?>
                    </div>
                </div>
            </section>
            <?php endif;
            ?>
            <?= $content ?>

        </section>
        <!-- END CONTENT -->

    </div>
    <!-- END WRAPPER -->

</div>
<!-- END MAIN -->



<!-- //////////////////////////////////////////////////////////////////////////// -->

<!-- START FOOTER -->
<footer class="page-footer">
    <div class="footer-copyright">
        <div class="container">
            <span>Copyright © 2016 <a class="grey-text text-lighten-4" href="http://www.foodforallnations.com" target="_blank">Food For All Nations</a> All rights reserved.</span>
        </div>
    </div>
</footer>
<!-- END FOOTER -->



<!-- ================================================
Scripts
================================================ -->

<!-- jQuery Library -->
<script type="text/javascript" src="<?= $view['assets']->getUrl('materialize/js/plugins/jquery-1.11.2.min.js')?>"></script>
<!--materialize js-->
<script type="text/javascript" src="<?= $view['assets']->getUrl('materialize/js/materialize.min.js')?>"></script>
<!--prism
<script type="text/javascript" src="<?= $view['assets']->getUrl('materialize/js/prism/prism.js')?>"></script>-->
<!--scrollbar-->
<script type="text/javascript" src="<?= $view['assets']->getUrl('materialize/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js')?>"></script>
<!-- chartist -->
<script type="text/javascript" src="<?= $view['assets']->getUrl('materialize/js/plugins/chartist-js/chartist.min.js')?>"></script>

<!--plugins.js - Some Specific JS codes for Plugin Settings-->
<script type="text/javascript" src="<?= $view['assets']->getUrl('materialize/js/plugins.min.js')?>"></script>
<!--custom-script.js - Add your own theme custom JS-->
<script type="text/javascript" src="<?= $view['assets']->getUrl('materialize/js/custom-script.js')?>"></script>



<?php foreach ($j_scripts as $script):?>
    <script src="<?php echo $view['assets']->getUrl($script)?>"></script>
<?php endforeach?>



</body>


<!-- Mirrored from demo.geekslabs.com/materialize/v3.1/page-blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Dec 2016 19:44:10 GMT -->
</html>
