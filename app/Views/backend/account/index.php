<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/22/2016
 * Time: 1:51 PM
 */
/** @var Models\Member $member */
/** @var Models\BankDetail $bank_detail */

use Framework\TinyMvc;
use Globals\Utility;
use Globals\AppService;
use Framework\Helper\Html;
?>

<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
    <div class="container">
        <div class="row">
            <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">My Account</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?= \Framework\TinyMvc::toRoute(\Globals\AppService::RouteBackendDashboard) ?>">Dashboard</a></li>
                    <li class="active">My Account</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs end-->


<section class="section">
    <div class="row ">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">
                        Membership Information
                    </span>

                    <form role="form">
                        <div class="row">
                            <div class="form-group col-md-3"> <label class="control-label">Membership Id</label>
                                <input type="text" class="form-control underlined" readonly value="<?= $member->getMembershipId() ?>">
                            </div>

                            <div class="form-group col-md-3"> <label class="control-label">Username</label>
                                <input type="text" class="form-control underlined" readonly value="<?= $member->getUsername() ?>">
                            </div>

                            <div class="form-group col-md-5">
                                <a href="#changePassword" data-toggle="modal" data-target="#changePassword" class="btn btn-primary modal-trigger  waves-effect waves-light">Change Password</a>

                                <a href="#changePin" data-toggle="modal" data-target="#changePin" class="btn btn-primary modal-trigger waves-effect waves-light">Change Transaction Pin</a>

                                <a href="#addAccount" data-toggle="modal" data-target="#addAccount" class="btn btn-primary modal-trigger waves-effect waves-light">Add Account</a>
                            </div>

                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>

    <div class="row sameheight-container">
        <div class="col s6">
            <div class="card card-block sameheight-item">
                <div class="card-content">
                    <span class="card-title">
                        Personal details
                    </span>

                    <form method="post" role="form" action="<?= TinyMvc::toRoute(AppService::UPDATE_PERSONAL_INFORMATION) ?>">
                        <div class="form-group"> <label class="control-label">First Name</label>
                            <input name="member[firstname]" type="text" class="form-control underlined" value="<?= $member->getFirstname() ?>">
                        </div>
                        <div class="form-group"> <label class="control-label">Last Name</label>
                            <input name="member[lastname]" type="text" class="form-control underlined" value="<?= $member->getLastname() ?>">
                        </div>

                        <div class="form-group"> <label class="control-label">Date of Birth</label>
                            <input name="member[dob]" type="date" class="form-control underlined" value="<?= $member->getDob() ?>">
                        </div>

                        <div class="form-group"> <label class="control-label">Gender</label>
                            <?= Html::selectFor('member[sex]', ['Male', 'Female'], $member->getSex(), null, null, ['class' => 'form-control']) ?>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Save Changes"/>
                        </div>
                    </form>

                </div>

            </div>
        </div>


        <div class="col s6">
            <div class="card card-block sameheight-item">
                <div class="card-content">
                    <span class="card-title">
                        Contact details
                    </span>

                    <form method="post" role="form" action="<?= TinyMvc::toRoute(AppService::UPDATE_CONTACT_INFORMATION) ?>">

                        <div class="form-group"> <label class="control-label">Phone Number</label>
                            <input name="member[phonenumber]" type="text" class="form-control underlined" value="<?= $member->getPhonenumber() ?>">
                        </div>
                        <div class="form-group"> <label class="control-label">Country</label>
                            <input name="member[country]" type="text" class="form-control underlined" value="<?= $member->getCountry() ?>">
                        </div>

                        <div class="form-group"> <label class="control-label">State</label>
                            <input name="member[state]" type="text" class="form-control underlined" value="<?= $member->getState() ?>">
                        </div>

                        <div class="form-group"> <label class="control-label">City</label>
                            <input name="member[city]" type="text" class="form-control underlined" value="<?= $member->getCity() ?>">
                        </div>

                        <div class="form-group"> <label class="control-label">Address</label>
                            <input name="member[address]" type="text" class="form-control underlined" value="<?= $member->getAddress() ?>">
                        </div>


                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Save Changes"/>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

    <div class="row sameheight-container">

        <div class="col s6">
            <div class="card card-block sameheight-item">
                <div class="card-content">
                    <span class="card-title">
                        Next of Kin
                    </span>
                    <form method="post" role="form" action="<?= TinyMvc::toRoute(AppService::UPDATE_NEXT_OF_KIN) ?>">
                        <div class="form-group"> <label class="control-label">Name</label>
                            <input name="member[nameofkin]" type="text" class="form-control underlined" value="<?= $member->getNameofkin() ?>">
                        </div>

                        <div class="form-group"> <label class="control-label">Relationship</label>
                            <input name="member[kinrelationship]" type="text" class="form-control underlined" value="<?= $member->getKinrelationship() ?>">
                        </div>
                        <div class="form-group"> <label class="control-label">Phone number</label>
                            <input name="member[phonenumberofkin]" type="text" class="form-control underlined" value="<?= $member->getPhonenumberofkin() ?>">
                        </div>

                        <div class="form-group"> <label class="control-label">Address</label>
                            <input name="member[nextofkinaddress]" type="text" class="form-control underlined" value="<?= $member->getNextofkinaddress() ?>">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Save Changes"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col s6">
            <div class="card card-block sameheight-item">
                <div class="card-content">
                    <span class="card-title">
                        Bank detail
                    </span>

                    <form method="post" role="form" action="<?= TinyMvc::toRoute(AppService::UPDATE_BANK_DETAIL) ?>">
                        <div class="form-group"> <label class="control-label">Bank Name</label>
                            <input name="bank_detail[bankName]" type="text" class="form-control underlined" value="<?= $bank_detail->getBankName() ?>">
                        </div>

                        <div class="form-group"> <label class="control-label">Branch</label>
                            <input name="bank_detail[branchName]" type="text" class="form-control underlined" value="<?= $bank_detail->getBranchName() ?>">
                        </div>

                        <div class="form-group"> <label class="control-label">Account Name</label>
                            <input name="bank_detail[accountName]" type="text" class="form-control underlined" value="<?= $bank_detail->getAccountName() ?>">
                        </div>

                        <div class="form-group"> <label class="control-label">Account Number</label>
                            <input name="bank_detail[accountNumber]" type="text" class="form-control underlined" value="<?= $bank_detail->getAccountNumber() ?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Save Changes"/>
                        </div>
                    </form>

                </div>

            </div>
        </div>


    </div>
</section>

<!-- Modal -->
<div id="changePassword" class="modal fade" role="dialog">
    <nav class="task-modal-nav red">
        <div class="nav-wrapper">
            <div class="left col s12 m5 l5">
                <ul>
                    <li><a href="#!" class="todo-menu"><i class="modal-action modal-close  mdi-hardware-keyboard-backspace"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="modal-content">

        <div class="row">
            <div class="col s12">
                <form method="post" action="<?= TinyMvc::toRoute(AppService::PASSWORD_RESET) ?>">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label">Current Password</label>
                                <input name="data[old_password]" type="password" class="form-control underlined">
                            </div>


                            <div class="form-group">
                                <label class="control-label">New Password</label>
                                <input name="data[new_password]" type="password" class="form-control underlined">
                            </div>


                            <div class="form-group">
                                <label class="control-label">Confirm Password</label>
                                <input name="data[confirm_password]" type="password" class="form-control underlined">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="modal-action modal-close   btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-default green">Change Password</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div id="changePin" class="modal fade" role="dialog">
    <nav class="task-modal-nav red">
        <div class="nav-wrapper">
            <div class="left col s12 m5 l5">
                <ul>
                    <li><a href="#!" class="todo-menu"><i class="modal-action modal-close  mdi-hardware-keyboard-backspace"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="modal-content">

        <form method="post" action="<?= TinyMvc::toRoute(AppService::PIN_RESET) ?>">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">PIN Reset</h4>
                </div>
                <div class="modal-body">
                    <p>We will send a link to your email address to reset your PIN</p>


                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-action modal-close btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default green">Continue</button>
                </div>
            </div>

        </form>

    </div>
</div>

<!-- Modal -->
<div id="addAccount" class="modal fade" role="dialog">
    <nav class="task-modal-nav red">
        <div class="nav-wrapper">
            <div class="left col s12 m5 l5">
                <ul>
                    <li><a href="#!" class="todo-menu"><i class="modal-action modal-close  mdi-hardware-keyboard-backspace"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="modal-content">

        <form id="signup-form" action="<?= TinyMvc::toRoute(AppService::AddAccount) ?>" method="post" novalidate="">
            <!-- Modal content-->
            <div class="modal-content" style="width: 700px !important;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Account</h4>
                </div>
                <div class="modal-body">

                        <div class="form-group">
                            <label for="firstname">Sponsor</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control underlined" name="sponsorId" id="sponsorId" placeholder="Enter sponsor Id" value="<?= $member->getMembershipId() ?>">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control underlined" name="parentId" id="parentId" placeholder="Enter Parent Id" value="<?= $member->getMembershipId() ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="firstname">Registration</label>
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="number" class="form-control underlined" name="numberOfAccounts" id="numberOfAccounts" placeholder="Enter number of accounts">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control underlined" name="pin" id="pin" placeholder="Enter registration PIN">
                                </div>
                                <div class="col-md-3">
                                    <p><a href="<?= TinyMvc::toRoute(AppService::BuyPin) ?>">Buy PIN</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">Login Info</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="email" class="form-control underlined" name="email" id="email" placeholder="Enter email address" required="" value="<?= $member->getEmailAddress() ?>">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control underlined" name="username" id="username" placeholder="Enter your username" required="" value="<?= $member->getUsername() ?>2">
                                </div>
                                <div class="col-md-3">
                                    <input type="password" class="form-control underlined" name="password" id="password" placeholder="Enter password" required=""> </div>
                                <div class="col-md-3"> <input type="password" class="form-control underlined" name="retype_password" id="retype_password" placeholder="Re-type password" required=""> </div>
                            </div>
                        </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default modal-action modal-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Add Account</button>
                </div>
            </div>

        </form>

    </div>
</div>



