<?php
use Globals\AppService;
use Framework\TinyMvc;
use Globals\Utility;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?= \Helpers\Html::encode((isset($title)?$title.' - ':'').TinyMvc::$config['AppTitle']) ?> </title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/icon" href="<?= $view['assets']->getUrl("themes/food/assets/images/favicon.ico")?>"/>

    <link href="<?= $view['assets']->getUrl("themes/food/assets/css/font-awesome.css")?>" rel="stylesheet">
    <link href="<?= $view['assets']->getUrl("themes/food/assets/css/bootstrap.css")?>" rel="stylesheet">
    <link href="<?= $view['assets']->getUrl("themes/food/assets/css/slick.css")?>" rel="stylesheet">
    <link href="<?= $view['assets']->getUrl("themes/food/assets/css/jquery.fancybox.css")?>" rel="stylesheet">
    <link href="<?= $view['assets']->getUrl("themes/food/assets/css/animate.css")?>" rel="stylesheet">
    <link href="<?= $view['assets']->getUrl("themes/food/assets/css/bootstrap-progressbar-3.3.4.css")?>" rel="stylesheet">
    <link href="<?= $view['assets']->getUrl("themes/food/assets/css/theme-color/default-theme.css")?>" rel="stylesheet">
    <link href="<?= $view['assets']->getUrl("themes/food/assets/style.css")?>" rel="stylesheet">


    <!-- Fonts -->

    <!-- Open Sans for body font -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!-- Lato for Title -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>



<!-- SCROLL TOP BUTTON -->
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<!-- END SCROLL TOP BUTTON -->

<!-- Start header -->
<header id="header">
    <!-- header top search -->
    <div class="header-top">
        <div class="container">
            <form action="">
                <div id="search">
                    <input type="text" placeholder="Type your search keyword here and hit Enter..." name="s" id="m_search" style="display: inline-block;">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- header bottom -->
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="header-contact">
                        <ul>
                            <li>
                                <div class="phone">
                                    <i class="fa fa-phone"></i>
                                    +1(800) 699-7071
                                </div>
                            </li>
                            <li>
                                <div class="mail">
                                    <i class="fa fa-envelope"></i>
                                    iam@domain.com
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="header-login">
                        <a class="login modal-form" data-target="#login-form" data-toggle="modal" href="#">Login Here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End header -->

<!-- Start login modal window -->
<div aria-hidden="false" role="dialog" tabindex="-1" id="login-form" class="modal leread-modal fade in">
    <div class="modal-dialog">
        <!-- Start login section -->
        <div id="login-content" class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-unlock-alt"></i>Login</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('/login')}}" >
                    <div class="form-group">
                        <input type="text" name="email" placeholder="User name" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" class="form-control">
                    </div>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="loginbox">
                        <label><input type="checkbox"><span>Remember me</span></label>

                        <button class="btn signin-btn" name="login" >SIGN IN</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer footer-box">
                <a href="#">Forgot password ?</a>
                <span>No account ? <a  href="{{url('/join-now')}}">Register</a></span>
            </div>
        </div>
        <!-- Start signup section -->
        <div id="signup-content" class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-lock"></i>Sign Up</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input placeholder="Name" class="form-control">
                    </div>
                    <div class="form-group">
                        <input placeholder="Username" class="form-control">
                    </div>
                    <div class="form-group">
                        <input placeholder="Email" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Password" class="form-control">
                    </div>
                    <div class="signupbox">
                        <span>Already got account? <a id="login-btn" href="#">Sign In.</a></span>
                    </div>
                    <div class="loginbox">
                        <label><input type="checkbox"><span>Remember me</span><i class="fa"></i></label>
                        <button class="btn signin-btn" type="button">SIGN UP</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End login modal window -->

<!-- BEGIN MENU -->
<section id="menu-area">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- LOGO -->
                <!-- TEXT BASED LOGO -->
                <a class="navbar-brand" href="<?= TinyMvc::toRoute(AppService::RouteHome, ['la' => 'en']) ?>"><?= TinyMvc::$config['AppTitle'] ?> </a>
                <!-- IMG BASED LOGO  -->
                <!-- <a class="navbar-brand" href="index.html"><img src="assets/images/logo.png" alt="logo"></a> -->
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
                    <li class=""><a href="{{url('/index')}}">Home</a></li>
                    <li><a href="{{url('/about-us')}}">About us</a></li>
                    <li><a href="{{url('/compensation-plan')}}">Compensation plan</a></li>
                    <li><a href="{{url('/service')}}">Service</a></li>
                    <li><a href="{{url('/portfolio')}}">Gallery</a></li>

                    <li><a href="{{url('/faq')}}">Faq</a></li>
                    <li><a href="{{url('/how-it-works')}}">How it works</a></li>
                    <li><a href="<?= TinyMvc::toRoute(AppService::Register) ?>">Join now</a></li>
                    <li><a href="{{url('/support')}}">Support</a></li>

                    <li><a href="{{url('/contact')}}">Contact</a></li>

                </ul>
            </div><!--/.nav-collapse -->
            <a href="#" id="search-icon">
                <i class="fa fa-search">
                </i>
            </a>
        </div>
    </nav>
</section>
<!-- END MENU -->

<?= $content ?>

<!-- Start footer -->
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="footer-left">
                    <p>Designed by <a href="#">World Feeders</a></p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="footer-right">
                    <a href="index.html"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End footer -->


<link href="<?= $view['assets']->getUrl("themes/food/assets/js/jQuery-2.1.4.min.js")?>" rel="stylesheet">

<link href="<?= $view['assets']->getUrl("themes/food/assets/js/bootstrap.js")?>" rel="stylesheet">

<link href="<?= $view['assets']->getUrl("themes/food/assets/js/slick.js")?>" rel="stylesheet">

<link href="<?= $view['assets']->getUrl("themes/food/assets/js/jquery.mixitup.js")?>" rel="stylesheet">

<link href="<?= $view['assets']->getUrl("themes/food/assets/js/jquery.fancybox.pack.js")?>" rel="stylesheet">

<link href="<?= $view['assets']->getUrl("themes/food/assets/js/waypoints.js")?>" rel="stylesheet">

<link href="<?= $view['assets']->getUrl("themes/food/assets/js/jquery.counterup.js")?>" rel="stylesheet">

<link href="<?= $view['assets']->getUrl("themes/food/assets/js/wow.js")?>" rel="stylesheet">

<link href="<?= $view['assets']->getUrl("themes/food/assets/js/bootstrap-progressbar.js")?>" rel="stylesheet">

<link href="<?= $view['assets']->getUrl("themes/food/assets/js/custom.js")?>" rel="stylesheet">
<!-- jQuery library -->



</body>
</html>