<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/23/2016
 * Time: 7:16 AM
 */

use Framework\TinyMvc;
use Globals\AppService;
use Globals\Utility;
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> <?= \Helpers\Html::encode((isset($title)?$title.' - ':'').TinyMvc::$config['AppTitle']) ?> </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->


    <link href="<?php echo $view['assets']->getUrl('modular_admin/css/vendor.css') ?>" rel="stylesheet">
    <link href="<?php echo $view['assets']->getUrl('modular_admin/css/app-green.css') ?>" rel="stylesheet">

</head>

<body>
<div class="auth">
    <div class="auth-container">
        <div class="card">
            <header class="auth-header">
                <h1 class="auth-title">
                    <div class="logo">
                        <span class="l l1"></span>
                        <span class="l l2"></span>
                        <span class="l l3"></span>
                        <span class="l l4"></span>
                        <span class="l l5"></span>
                    </div> <?= TinyMvc::$config['AppTitle'] ?>
                </h1> </header>
            <div class="auth-content">
                <?php
                if (!session_id()) @session_start();
                $flashMessage = new \Plasticbrain\FlashMessages\FlashMessages();
                $flashMessage->display();
                ?>
                <p class="text-xs-center">LOGIN TO CONTINUE</p>
                <form id="login-form" action="<?= TinyMvc::toRoute(AppService::Login)?>" method="POST" novalidate="">
                    <div class="form-group"> <label for="login">Username</label> <input type="text" class="form-control underlined" name="login" id="login" placeholder="Your username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label> <input type="password" class="form-control underlined" name="password" id="password" placeholder="Your password" required>
                    </div>
                    <div class="form-group"> <label for="remember">
                            <input class="checkbox" id="remember" type="checkbox">
                            <span>Remember me</span>
                        </label> <a href="<?= TinyMvc::toRoute(AppService::ForgotPassword) ?>" class="forgot-btn pull-right">Forgot password?</a> </div>
                    <div class="form-group"> <button type="submit" class="btn btn-block btn-primary">Login</button> </div>
                    <div class="form-group">
                        <p class="text-muted text-xs-center">Do not have an account? <a href="<?= TinyMvc::toRoute(AppService::Register) ?>">Sign Up!</a></p>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-xs-center">
            <a href="<?= TinyMvc::toRoute(AppService::RouteHome) ?>" class="btn btn-secondary rounded btn-sm"> <i class="fa fa-arrow-left"></i> Back to home page </a>
        </div>
    </div>
</div>
<!-- Reference block for JS -->
<div class="ref" id="ref">
    <div class="color-primary"></div>
    <div class="chart">
        <div class="color-primary"></div>
        <div class="color-secondary"></div>
    </div>
</div>

<script src="<?php echo $view['assets']->getUrl('modular_admin/js/vendor.js')?>"></script>
<script src="<?php echo $view['assets']->getUrl('modular_admin/js/app.js')?>"></script>

<?php foreach ($j_scripts as $script):?>
    <script src="<?php echo $view['assets']->getUrl($script)?>"></script>
<?php endforeach?>
</body>

</html>
