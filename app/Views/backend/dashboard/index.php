<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/2/2016
 * Time: 5:15 PM
 */
/** @var Models\Member $member */

use Models\MatrixStage;
?>

<!--start container-->
<div class="container">

    <!-- profile-page-header -->
    <div id="profile-page-header" class="card">
        <div class="card-image waves-effect waves-block waves-light">
            <img class="activator" src="<?= $view['assets']->getUrl('materialize/images/user-profile-bg.jpg') ?>" alt="user background">
        </div>
        <figure class="card-profile-image">
            <img src="<?= empty($member->getProfileImage())? '/web/themes/food/images/empty-member.png': $view['assets']->getUrl('uploads/profile/'.$member->getProfileImage())?>" alt="profile image" class="circle z-depth-2 responsive-img activator">
        </figure>
        <div class="card-content">
            <div class="row">
                <div class="col s3 offset-s2">
                    <h4 class="card-title grey-text text-darken-4"><?= $member->getFullname() ?></h4>
                    <p class="medium-small grey-text"><?= MatrixStage::getStageName($member->getStage()) ?></p>
                </div>
                <div class="col s2 center-align">
                    <h4 class="card-title grey-text text-darken-4">ID</h4>
                    <p class="medium-small grey-text"><?= $member->getMembershipId() ?></p>
                </div>
                <div class="col s2 center-align">
                    <h4 class="card-title grey-text text-darken-4">Stage</h4>
                    <p class="medium-small grey-text"><?= $member->getGenealogy()->getStage()->getLabel() ?></p>
                </div>
                <div class="col s2 center-align">
                    <h4 class="card-title grey-text text-darken-4">Level</h4>
                    <p class="medium-small grey-text"><?= $member->getGenealogy()->getLevel()->getLabel() ?></p>
                </div>
                <div class="col s1 right-align">
                    <a class="btn-floating activator waves-effect waves-light darken-2 right">
                        <i class="mdi-action-perm-identity"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-reveal">
            <p>
                <span class="card-title grey-text text-darken-4"><?= $member->getFullname() ?> <i class="mdi-navigation-close right"></i></span>
                <span><i class="mdi-action-perm-identity cyan-text text-darken-2"></i> <?= $member->getUsername()?> </span>
            </p>

           <!-- <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>-->

            <p><i class="mdi-action-perm-phone-msg cyan-text text-darken-2"></i> <?= $member->getPhonenumber() ?></p>
            <p><i class="mdi-communication-email cyan-text text-darken-2"></i> <?= $member->getEmailAddress()?></p>
            <p><i class="mdi-social-cake cyan-text text-darken-2"></i> <?= $member->getDob() ?></p>
            <p><i class="mdi-device-airplanemode-on cyan-text text-darken-2"></i> <?= $member->getState().' - '.$member->getCountry() ?></p>
        </div>
    </div>
    <!--/ profile-page-header -->



    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!--card stats start-->
    <div id="card-stats">
        <div class="row">
            <div class="col s12 m6 l3">
                <div class="card">
                    <div class="card-content  green white-text">
                        <p class="card-stats-title"><i class="mdi-editor-attach-money"></i> Total Income</p>
                        <h4 class="card-stats-number">$<?= $member->getTotalEarning() ?></h4>
                    </div>
                    <div class="card-action  green darken-2">
                        <div id="clients-bar" class="center-align"></div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="card">
                    <div class="card-content pink lighten-1 white-text">
                        <p class="card-stats-title"><i class="mdi-editor-attach-money"></i> Amount Withdrawn</p>
                        <h4 class="card-stats-number">$<?= $member->getTotalWithdrawal() ?></h4>

                    </div>
                    <div class="card-action  pink darken-2">
                        <div id="invoice-line" class="center-align"></div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="card">
                    <div class="card-content blue-grey white-text">
                        <p class="card-stats-title"><i class="mdi-editor-attach-money"></i> Cash Balance</p>
                        <h4 class="card-stats-number">$<?= $member->getCashBalance() ?></h4>

                    </div>
                    <div class="card-action blue-grey darken-2">
                        <div id="profit-tristate" class="center-align"></div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="card">
                    <div class="card-content purple white-text">
                        <p class="card-stats-title"><i class="mdi-editor-attach-money"></i>Food Balance</p>
                        <h4 class="card-stats-number">$<?= $member->getFoodBalance() ?></h4>
                    </div>
                    <div class="card-action purple darken-2">
                        <div id="sales-compositebar" class="center-align"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--card stats end-->

    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <div class="section">
        <div class="col s12">
            <ul id="task-card" class="collection with-header">
                <li class="collection-header green">
                    <h4 class="task-card-title">Recent Notifications</h4>
                </li>
                <li class="collection-item dismissable">
                    <p>This is what the system has to say about something</p>

                </li>

                <li class="collection-item dismissable">
                    <p>This is what the system has to say about something</p>

                </li>
            </ul>

        </div>
    </div>

</div>
<!--end container-->

