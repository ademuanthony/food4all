<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/23/2016
 * Time: 7:35 AM
 */

use Framework\TinyMvc;
use Globals\AppService;
use Globals\Utility;

/** @var \Models\TempMember $member */
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

    <style>
        .auth-container{
            width:700px !important;
        }
    </style>

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
                    </div>        <?= TinyMvc::$config['AppTitle'] ?> Signup
                </h1> </header>
            <div class="auth-content">
                <?php
                if (!session_id()) @session_start();
                $flashMessage = new \Plasticbrain\FlashMessages\FlashMessages();
                $flashMessage->display();
                ?>
                <form id="signup-form" method="post" novalidate="">

                    <div class="form-group">
                        <label>Registration PIN</label>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control underlined" name="pins" placeholder="Enter PINs seperated with comma">
                            </div>
                            <div class="col-md-3" style="display: none;">
                                <p><a href="<?= TinyMvc::toRoute(AppService::BuyPin) ?>">Buy PIN</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">Continue</button>
                    </div>
                    <div class="form-group">
                        <p class="text-muted text-xs-center">
                            Already have an account? <a href="<?= TinyMvc::toRoute(AppService::Login)?>">Login!</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-xs-center">
            <a href="<?= TinyMvc::toRoute(AppService::Register) ?>" class="btn btn-secondary rounded btn-sm"> <i class="fa fa-arrow-left"></i> Go Back </a>
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
