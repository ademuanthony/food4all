<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 11/26/2016
 * Time: 12:41 PM
 */

use Helpers\Html;
use Framework\TinyMvc;
use Globals\AppConstants;
use Globals\AppService;
use Globals\Utility;
?>

<!DOCTYPE html>
<html lang="en">

    <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Food for all nations">
    <meta name="author" content="Ademu Anthony">
    <meta name="keyword" content="food,money">
    <link rel="shortcut icon" href="img/favicon.png">

    <title> <?= Html::encode((isset($title)?$title.' - ':'').TinyMvc::$config['AppTitle']) ?> </title>

    <!-- Icons -->
    <link href="<?php echo $view['assets']->getUrl('leaf/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?php echo $view['assets']->getUrl('leaf/css/simple-line-icons.css') ?>" rel="stylesheet">

    <!-- Premium Icons -->
    <link href="<?php echo $view['assets']->getUrl('leaf/css/glyphicons.css') ?>" rel="stylesheet">
    <link href="<?php echo $view['assets']->getUrl('leaf/css/glyphicons-filetypes.css') ?>" rel="stylesheet">
    <link href="<?php echo $view['assets']->getUrl('leaf/css/glyphicons-social.css') ?>" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="<?php echo $view['assets']->getUrl('leaf/css/style.css') ?>" rel="stylesheet">


    <?php foreach ($c_styles as $style):?>
        <link href="<?php echo $view['assets']->getUrl($style) ?>" rel="stylesheet">
    <?php endforeach?>

</head>

<body class="navbar-fixed sidebar-nav">
<header class="navbar">
    <div class="container-fluid">
        <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">☰</button>
        <a class="navbar-brand" href="#"></a>
        <ul class="nav navbar-nav hidden-md-down">
            <li class="nav-item">
                <a class="nav-link navbar-toggler layout-toggler" href="#">☰</a>
            </li>

            <li class="nav-item px-1">
                <a class="nav-link" href="#">Dashboard</a>
            </li>
            <li class="nav-item px-1">
                <a class="nav-link" href="#">Users</a>
            </li>
            <li class="nav-item px-1">
                <a class="nav-link" href="#">Settings</a>
            </li>
        </ul>
        <ul class="nav navbar-nav pull-right hidden-md-down">
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="icon-bell"></i><span class="tag tag-pill tag-danger">5</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="icon-list"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="icon-location-pin"></i></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="<?php echo $view['assets']->getUrl('leaf/img/avatars/6.jpg') ?>" class="img-avatar" alt="admin@bootstrapmaster.com">
                    <span class="hidden-md-down">admin</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">

                    <div class="dropdown-header text-xs-center">
                        <strong>Account</strong>
                    </div>

                    <a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> Updates<span class="tag tag-info">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-envelope-o"></i> Messages<span class="tag tag-success">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-tasks"></i> Tasks<span class="tag tag-danger">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-comments"></i> Comments<span class="tag tag-warning">42</span></a>

                    <div class="dropdown-header text-xs-center">
                        <strong>Settings</strong>
                    </div>

                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-usd"></i> Payments<span class="tag tag-default">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-file"></i> Projects<span class="tag tag-primary">42</span></a>
                    <div class="divider"></div>
                    <a class="dropdown-item" href="#"><i class="fa fa-shield"></i> Lock Account</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-lock"></i> Logout</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link aside-toggle" href="#">☰</a>
            </li>

        </ul>
    </div>
</header>

<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">

            <li class="nav-item <?= (Utility::isActiveMenu(AppService::RouteBackendDashboard)?'active':''); ?>">
                <a class="nav-link" href="<?= TinyMvc::toRoute(AppService::RouteBackendDashboard) ?>"> <i class="fa fa-home"></i> Dashboard </a>
            </li>

            <li class="nav-item nav-dropdown <?= ((isset($currentMenu) && $currentMenu == AppService::Genealogy)?'active open':''); ?>">
                <a class="nav-link nav-dropdown-toggle" href="#"> <i class="fa fa-bar-chart"></i> Genealogy <i class="fa arrow"></i> </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item <?= (Utility::isActiveMenu(AppService::Genealogy)?'active':''); ?>">
                        <a class="nav-link" href="<?= TinyMvc::toRoute(AppService::Genealogy) ?>">
                            My Genealogy
                        </a>
                    </li>
                    <li class="nav-item <?= (Utility::isActiveMenu(AppService::Genealogy_Direct_Down_Line)?'active':''); ?>">
                        <a class="nav-link" href="<?= TinyMvc::toRoute(AppService::Genealogy_Direct_Down_Line) ?>">
                            Direct Downlines
                        </a>
                    </li>
                    <li class="nav-item <?= (Utility::isActiveMenu(AppService::Genealogy_My_Down_Line_tree)?'active':''); ?>">
                        <a class="nav-link" href="<?= TinyMvc::toRoute(AppService::Genealogy_My_Down_Line_tree) ?>">
                            Downline Tree
                        </a>
                    </li>
                    <li class="nav-item <?= (Utility::isActiveMenu(AppService::Genealogy_My_Down_Line_List)?'active':''); ?>">
                        <a class="nav-link" href="<?= TinyMvc::toRoute(AppService::Genealogy_My_Down_Line_List) ?>">
                            Downline List
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item <?= (Utility::isActiveMenu(AppService::Earnings) || (isset($currentMenu) && $currentMenu == AppService::Earnings)?'active':''); ?>">
                <a class="nav-link" href="<?= TinyMvc::toRoute(AppService::Earnings) ?>"> <i class="fa fa-dollar"></i> Earnings </a>
            </li>


            <li class="nav-item <?= (Utility::isActiveMenu(AppService::Profile) || (isset($currentMenu) && $currentMenu == AppService::Profile)?'active':''); ?>">
                <a class="nav-link" href="<?= TinyMvc::toRoute(AppService::Profile) ?>"> <i class="fa fa-user"></i> My Account </a>
            </li>

            <li class="nav-item nav-dropdown <?= ((isset($currentMenu) && $currentMenu == AppService::Shop)?'active open':''); ?>">
                <a class="nav-link" href="#"> <i class="fa fa-shopping-cart"></i> Shop <i class="fa arrow"></i> </a>
                <ul>
                    <li class="nav-item <?= (Utility::isActiveMenu(AppService::Pin)?'active':''); ?>">
                        <a class="nav-link" href="<?= TinyMvc::toRoute(AppService::Pin) ?>">
                            Buy Pin
                        </a>
                    </li>
                    <li class="nav-item <?= (Utility::isActiveMenu(AppService::RouteBackendCategories)?'active':''); ?>">
                        <a class="nav-link" href="<?= TinyMvc::toRoute(AppService::RouteBackendCategories) ?>">
                            Buy Food
                        </a>
                    </li>
                    <li class="nav-item <?= (Utility::isActiveMenu(AppService::RouteBackendAddCategory)?'active':''); ?>">
                        <a class="nav-link" href="<?= TinyMvc::toRoute(AppService::RouteBackendAddCategory) ?>">
                            My Orders
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-dropdown <?= ((isset($currentMenu) && $currentMenu == AppService::RouteBackendCategories)?'active open':''); ?>">
                <a class="nav-link" href="#"> <i class="fa fa-money"></i> Transaction <i class="fa arrow"></i> </a>
                <ul>
                    <li class="nav-item <?= (Utility::isActiveMenu(AppService::RouteBackendCategories)?'active':''); ?>">
                        <a class="nav-link" href="<?= TinyMvc::toRoute(AppService::RouteBackendCategories) ?>">
                            Send Money
                        </a>
                    </li>
                    <li class="nav-item <?= (Utility::isActiveMenu(AppService::RouteBackendAddCategory)?'active':''); ?>">
                        <a class="nav-link" href="<?= TinyMvc::toRoute(AppService::RouteBackendAddCategory) ?>">
                            Received Money
                        </a>
                    </li>
                </ul>
            </li>

            <?php
            if(Utility::getInstance()->isUserInRole(\Models\Role::Admin)):
                ?>
                <li class="nav-item nav-dropdown <?= ((isset($currentMenu) && $currentMenu == AppService::RouteBackendCategories)?'active open':''); ?>">
                    <a class="nav-link" href="#"> <i class="fa fa-th-large"></i> Categories Manager <i class="fa arrow"></i> </a>
                    <ul>
                        <li class="nav-item <?= (Utility::isActiveMenu(AppService::RouteBackendCategories)?'active':''); ?>">
                            <a class="nav-link" href="<?= TinyMvc::toRoute(AppService::RouteBackendCategories) ?>">
                                Categories List
                            </a>
                        </li>
                        <li class="nav-item <?= (Utility::isActiveMenu(AppService::RouteBackendAddCategory)?'active':''); ?>">
                            <a class="nav-link" href="<?= TinyMvc::toRoute(AppService::RouteBackendAddCategory) ?>">
                                Create Category
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item nav-dropdown <?= ((isset($currentMenu) && $currentMenu == AppService::RouteBackendProducts)?'active open':''); ?>">
                    <a class="nav-link" href="#"> <i class="fa fa-rocket"></i> Products Manager <i class="fa arrow"></i> </a>
                    <ul>
                        <li class="nav-item <?= (Utility::isActiveMenu(AppService::RouteBackendProducts)?'active':''); ?>">
                            <a class="nav-link" href="<?= TinyMvc::toRoute(AppService::RouteBackendProducts) ?>">
                                Products List
                            </a> </li>
                        <li class="nav-item <?= (Utility::isActiveMenu(AppService::RouteBackendAddProduct)?'active':''); ?>">
                            <a class="nav-link" href="<?= TinyMvc::toRoute(AppService::RouteBackendAddProduct) ?>">
                                Create Product
                            </a> </li>
                    </ul>
                </li>

                <li class="nav-item <?= (Utility::isActiveMenu(AppService::RouteBackendOrders) || (isset($currentMenu) && $currentMenu == AppService::RouteBackendOrders)?'active':''); ?>">
                    <a class="nav-link" href="<?= TinyMvc::toRoute(AppService::RouteBackendOrders) ?>"> <i class="fa fa-shopping-cart"></i> Orders </a>
                </li>
            <?php endif;?>


        </ul>
    </nav>
</div>

<!-- Main content -->
<main class="main">

    <!-- Breadcrumb -->
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Admin</a>
        </li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>


    <div class="container-fluid">



        <div class="animated fadeIn">

            <?= $content ?>
        </div>


    </div>
    <!-- /.conainer-fluid -->
</main>

<aside class="aside-menu">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#timeline" role="tab"><i class="icon-list"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><i class="icon-speech"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#settings" role="tab"><i class="icon-settings"></i></a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="timeline" role="tabpanel">
            <div class="callout m-0 py-h text-muted text-xs-center bg-faded text-uppercase">
                <small><b>Today</b>
                </small>
            </div>
            <hr class="transparent mx-1 my-0">
            <div class="callout callout-warning m-0 py-1">
                <div class="avatar float-xs-right">
                    <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                </div>
                <div>Meeting with
                    <strong>Lucas</strong>
                </div>
                <small class="text-muted mr-1"><i class="icon-calendar"></i>&nbsp; 1 - 3pm</small>
                <small class="text-muted"><i class="icon-location-pin"></i>&nbsp; Palo Alto, CA</small>
            </div>
            <hr class="mx-1 my-0">
            <div class="callout callout-info m-0 py-1">
                <div class="avatar float-xs-right">
                    <img src="img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                </div>
                <div>Skype with
                    <strong>Megan</strong>
                </div>
                <small class="text-muted mr-1"><i class="icon-calendar"></i>&nbsp; 4 - 5pm</small>
                <small class="text-muted"><i class="icon-social-skype"></i>&nbsp; On-line</small>
            </div>
            <hr class="transparent mx-1 my-0">
            <div class="callout m-0 py-h text-muted text-xs-center bg-faded text-uppercase">
                <small><b>Tomorrow</b>
                </small>
            </div>
            <hr class="transparent mx-1 my-0">
            <div class="callout callout-danger m-0 py-1">
                <div>New UI Project -
                    <strong>deadline</strong>
                </div>
                <small class="text-muted mr-1"><i class="icon-calendar"></i>&nbsp; 10 - 11pm</small>
                <small class="text-muted"><i class="icon-home"></i>&nbsp; creativeLabs HQ</small>
                <div class="avatars-stack mt-h">
                    <div class="avatar avatar-xs">
                        <img src="img/avatars/2.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    </div>
                    <div class="avatar avatar-xs">
                        <img src="img/avatars/3.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    </div>
                    <div class="avatar avatar-xs">
                        <img src="img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    </div>
                    <div class="avatar avatar-xs">
                        <img src="img/avatars/5.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    </div>
                    <div class="avatar avatar-xs">
                        <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    </div>
                </div>
            </div>
            <hr class="mx-1 my-0">
            <div class="callout callout-success m-0 py-1">
                <div>
                    <strong>#10 Startups.Garden</strong>Meetup</div>
                <small class="text-muted mr-1"><i class="icon-calendar"></i>&nbsp; 1 - 3pm</small>
                <small class="text-muted"><i class="icon-location-pin"></i>&nbsp; Palo Alto, CA</small>
            </div>
            <hr class="mx-1 my-0">
            <div class="callout callout-primary m-0 py-1">
                <div>
                    <strong>Team meeting</strong>
                </div>
                <small class="text-muted mr-1"><i class="icon-calendar"></i>&nbsp; 4 - 6pm</small>
                <small class="text-muted"><i class="icon-home"></i>&nbsp; creativeLabs HQ</small>
                <div class="avatars-stack mt-h">
                    <div class="avatar avatar-xs">
                        <img src="img/avatars/2.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    </div>
                    <div class="avatar avatar-xs">
                        <img src="img/avatars/3.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    </div>
                    <div class="avatar avatar-xs">
                        <img src="img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    </div>
                    <div class="avatar avatar-xs">
                        <img src="img/avatars/5.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    </div>
                    <div class="avatar avatar-xs">
                        <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    </div>
                    <div class="avatar avatar-xs">
                        <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    </div>
                    <div class="avatar avatar-xs">
                        <img src="img/avatars/8.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    </div>
                </div>
            </div>
            <hr class="mx-1 my-0">
        </div>
        <div class="tab-pane p-1" id="messages" role="tabpanel">
            <div class="message">
                <div class="py-1 pb-3 mr-1 pull-left">
                    <div class="avatar">
                        <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        <span class="avatar-status tag-success"></span>
                    </div>
                </div>
                <div>
                    <small class="text-muted">Lukasz Holeczek</small>
                    <small class="text-muted pull-right mt-q">1:52 PM</small>
                </div>
                <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
            </div>
            <hr>
            <div class="message">
                <div class="py-1 pb-3 mr-1 pull-left">
                    <div class="avatar">
                        <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        <span class="avatar-status tag-success"></span>
                    </div>
                </div>
                <div>
                    <small class="text-muted">Lukasz Holeczek</small>
                    <small class="text-muted pull-right mt-q">1:52 PM</small>
                </div>
                <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
            </div>
            <hr>
            <div class="message">
                <div class="py-1 pb-3 mr-1 pull-left">
                    <div class="avatar">
                        <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        <span class="avatar-status tag-success"></span>
                    </div>
                </div>
                <div>
                    <small class="text-muted">Lukasz Holeczek</small>
                    <small class="text-muted pull-right mt-q">1:52 PM</small>
                </div>
                <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
            </div>
            <hr>
            <div class="message">
                <div class="py-1 pb-3 mr-1 pull-left">
                    <div class="avatar">
                        <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        <span class="avatar-status tag-success"></span>
                    </div>
                </div>
                <div>
                    <small class="text-muted">Lukasz Holeczek</small>
                    <small class="text-muted pull-right mt-q">1:52 PM</small>
                </div>
                <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
            </div>
            <hr>
            <div class="message">
                <div class="py-1 pb-3 mr-1 pull-left">
                    <div class="avatar">
                        <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        <span class="avatar-status tag-success"></span>
                    </div>
                </div>
                <div>
                    <small class="text-muted">Lukasz Holeczek</small>
                    <small class="text-muted pull-right mt-q">1:52 PM</small>
                </div>
                <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
            </div>
        </div>
        <div class="tab-pane p-1" id="settings" role="tabpanel">
            <h6>Settings</h6>

            <div class="aside-options">
                <div class="clearfix mt-2">
                    <small><b>Option 1</b>
                    </small>
                    <label class="switch switch-text switch-pill switch-success switch-sm pull-right">
                        <input type="checkbox" class="switch-input" checked="">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                    </label>
                </div>
                <div>
                    <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
                </div>
            </div>

            <div class="aside-options">
                <div class="clearfix mt-1">
                    <small><b>Option 2</b>
                    </small>
                    <label class="switch switch-text switch-pill switch-success switch-sm pull-right">
                        <input type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                    </label>
                </div>
                <div>
                    <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
                </div>
            </div>

            <div class="aside-options">
                <div class="clearfix mt-1">
                    <small><b>Option 3</b>
                    </small>
                    <label class="switch switch-text switch-pill switch-success switch-sm pull-right">
                        <input type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                    </label>
                </div>
            </div>

            <div class="aside-options">
                <div class="clearfix mt-1">
                    <small><b>Option 4</b>
                    </small>
                    <label class="switch switch-text switch-pill switch-success switch-sm pull-right">
                        <input type="checkbox" class="switch-input" checked="">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                    </label>
                </div>
            </div>

            <hr>
            <h6>System Utilization</h6>

            <div class="text-uppercase mb-q mt-2">
                <small><b>CPU Usage</b>
                </small>
            </div>
            <progress class="progress progress-xs progress-info m-0" value="25" max="100">25%</progress>
            <small class="text-muted">348 Processes. 1/4 Cores.</small>

            <div class="text-uppercase mb-q mt-h">
                <small><b>Memory Usage</b>
                </small>
            </div>
            <progress class="progress progress-xs progress-warning m-0" value="70" max="100">70%</progress>
            <small class="text-muted">11444GB/16384MB</small>

            <div class="text-uppercase mb-q mt-h">
                <small><b>SSD 1 Usage</b>
                </small>
            </div>
            <progress class="progress progress-xs progress-danger m-0" value="95" max="100">95%</progress>
            <small class="text-muted">243GB/256GB</small>

            <div class="text-uppercase mb-q mt-h">
                <small><b>SSD 2 Usage</b>
                </small>
            </div>
            <progress class="progress progress-xs progress-success m-0" value="10" max="100">10%</progress>
            <small class="text-muted">25GB/256GB</small>
        </div>
    </div>
</aside>


<footer class="footer">
        <span class="text-left">
            <a href="https://genesisui.com/">Leaf</a> © 2016 creativeLabs.
        </span>
        <span class="pull-right">
            Powered by <a href="https://genesisui.com/">GenesisUI</a>
        </span>
</footer>


<!-- Bootstrap and necessary plugins -->
<script src="<?php echo $view['assets']->getUrl('laef/js/libs/jquery.min.js')?>"></script>
<script src="<?php echo $view['assets']->getUrl('leaf/libs/tether.min.js')?>"></script>
<script src="<?php echo $view['assets']->getUrl('laef/js/libs/bootstrap.min.js')?>"></script>
<script src="<?php echo $view['assets']->getUrl('leaf/libs/pace.min.js')?>"></script>


<!-- Plugins and scripts required by all views -->
<script src="<?php echo $view['assets']->getUrl('leaf/libs/Chart.min.js')?>"></script>


<!-- GenesisUI main scripts -->
<script src="<?php echo $view['assets']->getUrl('leaf/libs/app.js')?>"></script>

<!-- Plugins and scripts required by this views -->
<script src="<?php echo $view['assets']->getUrl('leaf/libs/toastr.min.js')?>"></script>
<script src="<?php echo $view['assets']->getUrl('leaf/libs/gauge.min.js')?>"></script>
<script src="<?php echo $view['assets']->getUrl('leaf/libs/moment.min.js')?>"></script>
<script src="<?php echo $view['assets']->getUrl('leaf/libs/daterangepicker.js')?>"></script>


<!-- Custom scripts required by this view -->
<script src="<?php echo $view['assets']->getUrl('leaf/views/main.js')?>"></script>


<?php foreach ($j_scripts as $script):?>
    <script src="<?php echo $view['assets']->getUrl($script)?>"></script>
<?php endforeach?>
</body>


<!-- Mirrored from genesisui.com/demo/leaf/bootstrap4-static/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 26 Nov 2016 10:00:27 GMT -->
</html>
