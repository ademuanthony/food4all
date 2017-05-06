<?php

use Framework\TinyMvc;
use Helpers\Html;
use Globals\Utility;
use Globals\AppService;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="FoodforAllNations is a clarion call to feed the world with the basic necessities of life as a result of this we want to empower as many people as possible that believe that every life count and that no living soul should go to bed hungry.">
    <meta name="keywords" content="empower, food for all, feed the world, make money, 2x5 matrix, referral bonus, matching bonus, earn, earn a living">

    <title><?= Html::encode((isset($title)?$title.' - ':'').TinyMvc::$config['AppTitle']) ?></title>

    <!-- Favicons-->
    <link rel="icon" href="<?= $view['assets']->getUrl('app/images/logo.png') ?>" sizes="32x32">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="<?= $view['assets']->getUrl('materialize/images/favicon/apple-touch-icon-152x152.png')?>">
    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="<?= $view['assets']->getUrl('materialize/images/favicon/mstile-144x144.png')?>">
    <!-- For Windows Phone -->


    <!-- CORE CSS-->
    <link href="<?= $view['assets']->getUrl('front/css/materialize.css" type="text/css')?>" rel="stylesheet" media="screen,projection">
    <!-- CSS style Horizontal Nav-->
    <link href="<?= $view['assets']->getUrl('front/css/style.css')?>" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Font icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="<?= $view['assets']->getUrl('materialize/js/plugins/perfect-scrollbar/perfect-scrollbar.css')?>" type="text/css" rel="stylesheet" media="screen,projection">

</head>

<body>

<!-- START HEADER -->
<header id="header" class="page-topbar">
    <!-- start header nav-->
    <div class="navbar-fixed">
        <nav class="navbar-color">
            <div class="nav-wrapper">
                <ul class="left">
                    <li>
                        <h1 class="logo-wrapper">
                            <a href="<?= TinyMvc::toRoute(AppService::RouteHome) ?>" class="brand-logo darken-1">

                                <img style="height: 100px; width: 100px; margin: 14px 0 0 21px;" src="<?= $view['assets']->getUrl('app/images/logo.png')?>" alt="food4all logo">
                            </a>
                            <span class="logo-text">Food 4 All</span>
                        </h1>
                    </li>
                </ul>

                <ul id="ul-horizontal-nav" class="hide-on-med-and-down" style="color:#fff; margin-left: 230px;">
                    <li>
                        <a href="<?= TinyMvc::toRoute(AppService::RouteHome) ?>" class="white-text">
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= TinyMvc::toRoute(AppService::RouteAbout) ?>" class="white-text">
                            <span>About</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= TinyMvc::toRoute(AppService::CompensationPlan) ?>" class="white-text">
                            <span>Compensation Plan</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= TinyMvc::toRoute(AppService::Gallery) ?>" class="white-text">
                            <span>Gallery</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= TinyMvc::toRoute(AppService::Faq) ?>" class="white-text">
                            <span>FAQ</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= TinyMvc::toRoute(AppService::HowItWorks) ?>" class="white-text">
                            <span>How It Works</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= TinyMvc::toRoute(AppService::Register) ?>" class="white-text">
                            <span>Join Now</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= TinyMvc::toRoute(AppService::Login) ?>" class="white-text">
                            <span>Sign In</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= TinyMvc::toRoute(AppService::Contact) ?>" class="white-text">
                            <span>Contact</span>
                        </a>
                    </li>
                </ul>

                <ul class="right hide-on-med-and-down">
                    <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light translation-button"  data-activates="translation-dropdown"><img src="<?= $view['assets']->getUrl('front/images/flag-icons/United-States.png')?>" alt="USA" /></a>
                    </li>
                    <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a>
                    </li>
                    <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light notification-button" data-activates="notifications-dropdown"><i class="mdi-social-notifications"><small class="notification-badge">5</small></i>

                        </a>
                    </li>
                    <li><a href="#" data-activates="chat-out" class="waves-effect waves-block waves-light chat-collapse"><i class="mdi-communication-chat"></i></a>
                    </li>
                </ul>
                <!-- translation-button -->
                <ul id="translation-dropdown" class="dropdown-content">
                    <li>
                        <a href="#!"><img src="<?= $view['assets']->getUrl('front/images/flag-icons/United-States.png')?>" alt="English" />  <span class="language-select">English</span></a>
                    </li>
                    <li>
                        <a href="#!"><img src="<?= $view['assets']->getUrl('front/images/flag-icons/France.png')?>" alt="French" />  <span class="language-select">French</span></a>
                    </li>
                    <li>
                        <a href="#!"><img src="<?= $view['assets']->getUrl('front/images/flag-icons/China.png')?>" alt="Chinese" />  <span class="language-select">Chinese</span></a>
                    </li>
                    <li>
                        <a href="#!"><img src="<?= $view['assets']->getUrl('front/images/flag-icons/Germany.png')?>" alt="German" />  <span class="language-select">German</span></a>
                    </li>

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

        <!-- START CONTENT -->
        <section id="content">

            <!-- //////////////////////////////////////////////////////////////////////////// -->

            <?= $content ?>

            <!-- //////////////////////////////////////////////////////////////////////////// -->
                
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
            <span>Copyright © 2016 - <?php echo date("Y"); ?> <a class="grey-text text-lighten-4" href="http://www.foodforallnations.com" target="_blank">Food For All Nations</a> All rights reserved.</span>
        </div>
    </div>
</footer>
<!-- END FOOTER -->


<!-- ================================================
Scripts
================================================ -->

<!--Import jQuery before materialize.js-->
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->
<script type="text/javascript" src="<?= $view['assets']->getUrl('front/js/jquery-2.1.1.min.js');?>"></script>
<!-- Resource jQuery -->
<script type="text/javascript" src="<?= $view['assets']->getUrl('front/js/materialize.min.js');?>"></script>
<script type="text/javascript" src="<?= $view['assets']->getUrl('front/js/jquery.mobile.custom.min.js'); ?>"></script>
<script type="text/javascript" src="<?= $view['assets']->getUrl('front/js/main.js'); ?>"></script> 
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js"></script> -->
<script>
    $(document).ready(function(){
        $('.carousel.carousel-slider').carousel({fullWidth: true});
    });

    setInterval(function(){
        $('.carousel').carousel('next');
    }, 5000);

    //SCROLLSPY
    $(document).ready(function(){
        $('.scrollspy').scrollSpy();
    });
</script>
</body>

</html>
