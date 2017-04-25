<?php
use Framework\TinyMvc;
use Globals\AppService;
?>
<!-- Start single page header -->
<section id="single-page-header">
    <div class="overlay">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="single-page-header-left">
                        <h2>Login</h2>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- End single page header -->
<!-- Start error section  -->
<section id="error">
    <div class="container">
        <div class="row">
            <?php
            if (!session_id()) @session_start();
            $flashMessage = new \Plasticbrain\FlashMessages\FlashMessages();
            $flashMessage->display();
            ?>

            <div class="col-md-offset-3 col-md-6">
                <form method="POST" action="<?= TinyMvc::toRoute(AppService::Login); ?>" >
                    <div class="form-group">
                        <input type="text" name="login" placeholder="Username or email" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" class="form-control">
                    </div>
                    <div class="loginbox">
                        <label><input name="remember" type="checkbox"><span>Remember me</span></label>

                        <button class="btn signin-btn" type="submit" name="" >SIGN IN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>