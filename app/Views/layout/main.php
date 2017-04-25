<?php
use Framework\TinyMvc;
use Helpers\Html;
use Globals\Utility;
use Globals\AppService;

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> <?= Html::encode((isset($title)?$title.' - ':'').TinyMvc::$config['AppTitle']) ?> </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->
    <!-- Theme initialization

      public $css = [
        'modular_admin/css/vendor.css',
        'modular_admin/css/app-orange.css',
    ];
    public $js = [
        'modular_admin/js/vendor.js',
        'modular_admin/js/app.js',
    ];
     -->

    <link href="<?php echo $view['assets']->getUrl('modular_admin/css/vendor.css') ?>" rel="stylesheet">
    <link href="<?php echo $view['assets']->getUrl('modular_admin/css/app-green.css') ?>" rel="stylesheet">
    <link href="<?php echo $view['assets']->getUrl('modular_admin/css/main.css') ?>" rel="stylesheet">

    <?php foreach ($c_styles as $style):?>
        <link href="<?php echo $view['assets']->getUrl($style) ?>" rel="stylesheet">
    <?php endforeach?>
</head>

<body>


<div class="main-wrapper">
    <div class="app" id="app">
        <header class="header">
            <div class="header-block header-block-collapse hidden-lg-up"> <button class="collapse-btn" id="sidebar-collapse-btn">
                    <i class="fa fa-bars"></i>
                </button> </div>
            <div class="header-block header-block-search hidden-sm-down">
                <form role="search" action="<?= TinyMvc::toRoute(AppService::GenealogySearch) ?>">
                    <div class="input-container"> <i class="fa fa-search"></i>
                        <input type="search" placeholder="Search your downlines" name="membership_id" style="width: 100% !important; max-width: 100% !important;">
                        <div class="underline"></div>
                    </div>
                </form>
            </div>

            <div class="header-block header-block-nav">
                <ul class="nav-profile">

                    <li class="notifications new">
                        <a href="" data-toggle="dropdown"> <i class="fa fa-bell-o"></i> <sup>
                                <span class="counter"><?= count($notifications)?></span>
                            </sup> </a>
                        <div class="dropdown-menu notifications-dropdown-menu">
                            <ul class="notifications-container">
                                <?php foreach ($notifications as $notification) :?>
                                    <li>
                                        <a href="<?= TinyMvc::toRoute(AppService::ReadNotification, ['id' => $notification->getId()])?>" class="notification-item">
                                            <div class="body-col">
                                                <p> <span class="accent"><?= $notification->getMessage()?> </p>
                                            </div>
                                        </a>
                                    </li>

                                <?php endforeach;?>

                            </ul>
                            <footer>
                                <ul>
                                    <li> <a href="<?= TinyMvc::toRoute(AppService::Notifications) ?>">
                                            View All
                                        </a> </li>
                                </ul>
                            </footer>
                        </div>
                    </li>

                    <li class="profile dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <div class="img" > </div> <span class="name">
    			      <?= $member ?>
    			    </span> </a>
                        <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                            <a class="dropdown-item" href="<?= TinyMvc::toRoute(AppService::Profile) ?>"> <i class="fa fa-user icon"></i> My Account </a>
                            <a class="dropdown-item" href="#"> <i class="fa fa-bell icon"></i> Notifications </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= TinyMvc::toRoute(AppService::Logout) ?>"> <i class="fa fa-power-off icon"></i> Logout </a>
                        </div>
                    </li>
                </ul>
            </div>
        </header>

        <aside class="sidebar">
            <div class="sidebar-container">
                <div class="sidebar-header">
                    <div class="brand">
                        <div class="logo"> <span class="l l1"></span> <span class="l l2"></span> <span class="l l3"></span>
                            <span class="l l4"></span> <span class="l l5"></span> </div> Food4All </div>
                </div>
                <nav class="menu">
                    <ul class="nav metismenu" id="sidebar-menu">

                        <li class="<?= (Utility::isActiveMenu(AppService::RouteBackendDashboard)?'active':''); ?>">
                            <a href="<?= TinyMvc::toRoute(AppService::RouteBackendDashboard) ?>"> <i class="fa fa-home"></i> Dashboard </a>
                        </li>

                        <li class="<?= ((isset($currentMenu) && $currentMenu == AppService::Genealogy)?'active open':''); ?>">
                            <a href=""> <i class="fa fa-bar-chart"></i> Genealogy <i class="fa arrow"></i> </a>
                            <ul>
                                <li class="<?= (Utility::isActiveMenu(AppService::Genealogy)?'active':''); ?>">
                                    <a href="<?= TinyMvc::toRoute(AppService::Genealogy) ?>">
                                        My Genealogy
                                    </a>
                                </li>
                                <li class="<?= (Utility::isActiveMenu(AppService::Genealogy_Direct_Down_Line)?'active':''); ?>">
                                    <a href="<?= TinyMvc::toRoute(AppService::Genealogy_Direct_Down_Line) ?>">
                                        Direct Downlines
                                    </a>
                                </li>
                                <li class="<?= (Utility::isActiveMenu(AppService::Genealogy_My_Down_Line_tree)?'active':''); ?>">
                                    <a href="<?= TinyMvc::toRoute(AppService::Genealogy_My_Down_Line_tree) ?>">
                                        Downline Tree
                                    </a>
                                </li>
                                <li class="<?= (Utility::isActiveMenu(AppService::Genealogy_My_Down_Line_List)?'active':''); ?>">
                                    <a href="<?= TinyMvc::toRoute(AppService::Genealogy_My_Down_Line_List) ?>">
                                        Downline List
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="<?= (Utility::isActiveMenu(AppService::Earnings) || (isset($currentMenu) && $currentMenu == AppService::Earnings)?'active':''); ?>">
                            <a href="<?= TinyMvc::toRoute(AppService::Earnings) ?>"> <i class="fa fa-dollar"></i> Earnings </a>
                        </li>


                        <li class="<?= (Utility::isActiveMenu(AppService::Profile) || (isset($currentMenu) && $currentMenu == AppService::Profile)?'active':''); ?>">
                            <a href="<?= TinyMvc::toRoute(AppService::Profile) ?>"> <i class="fa fa-user"></i> My Account </a>
                        </li>

                        <li class="<?= ((isset($currentMenu) && $currentMenu == AppService::Shop)?'active open':''); ?>">
                            <a href=""> <i class="fa fa-shopping-cart"></i> Shop <i class="fa arrow"></i> </a>
                            <ul>
                                <li class="<?= (Utility::isActiveMenu(AppService::Pin)?'active':''); ?>">
                                    <a href="<?= TinyMvc::toRoute(AppService::Pin) ?>">
                                        Buy Pin
                                    </a>
                                </li>
                                <li class="<?= (Utility::isActiveMenu(AppService::RouteBackendCategories)?'active':''); ?>">
                                    <a href="<?= TinyMvc::toRoute(AppService::RouteBackendCategories) ?>">
                                        Buy Food
                                    </a>
                                </li>
                                <li class="<?= (Utility::isActiveMenu(AppService::RouteBackendAddCategory)?'active':''); ?>">
                                    <a href="<?= TinyMvc::toRoute(AppService::RouteBackendAddCategory) ?>">
                                        My Orders
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="<?= ((isset($currentMenu) && $currentMenu == AppService::RouteBackendCategories)?'active open':''); ?>">
                            <a href=""> <i class="fa fa-money"></i> Transaction <i class="fa arrow"></i> </a>
                            <ul>
                                <li class="<?= (Utility::isActiveMenu(AppService::RouteBackendCategories)?'active':''); ?>">
                                    <a href="<?= TinyMvc::toRoute(AppService::RouteBackendCategories) ?>">
                                        Send Money
                                    </a>
                                </li>
                                <li class="<?= (Utility::isActiveMenu(AppService::RouteBackendAddCategory)?'active':''); ?>">
                                    <a href="<?= TinyMvc::toRoute(AppService::RouteBackendAddCategory) ?>">
                                        Received Money
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <?php
                        if(Utility::getInstance()->isUserInRole(\Models\Role::Admin)):
                        ?>
                        <li class="<?= ((isset($currentMenu) && $currentMenu == AppService::RouteBackendCategories)?'active open':''); ?>">
                            <a href=""> <i class="fa fa-th-large"></i> Categories Manager <i class="fa arrow"></i> </a>
                            <ul>
                                <li class="<?= (Utility::isActiveMenu(AppService::RouteBackendCategories)?'active':''); ?>">
                                    <a href="<?= TinyMvc::toRoute(AppService::RouteBackendCategories) ?>">
                                        Categories List
                                    </a>
                                </li>
                                <li class="<?= (Utility::isActiveMenu(AppService::RouteBackendAddCategory)?'active':''); ?>">
                                    <a href="<?= TinyMvc::toRoute(AppService::RouteBackendAddCategory) ?>">
                                        Create Category
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="<?= ((isset($currentMenu) && $currentMenu == AppService::RouteBackendProducts)?'active open':''); ?>">
                            <a href=""> <i class="fa fa-rocket"></i> Products Manager <i class="fa arrow"></i> </a>
                            <ul>
                                <li class="<?= (Utility::isActiveMenu(AppService::RouteBackendProducts)?'active':''); ?>">
                                    <a href="<?= TinyMvc::toRoute(AppService::RouteBackendProducts) ?>">
                                        Products List
                                    </a> </li>
                                <li class="<?= (Utility::isActiveMenu(AppService::RouteBackendAddProduct)?'active':''); ?>">
                                    <a href="<?= TinyMvc::toRoute(AppService::RouteBackendAddProduct) ?>">
                                        Create Product
                                    </a> </li>
                            </ul>
                        </li>

                        <li class="<?= (Utility::isActiveMenu(AppService::RouteBackendOrders) || (isset($currentMenu) && $currentMenu == AppService::RouteBackendOrders)?'active':''); ?>">
                            <a href="<?= TinyMvc::toRoute(AppService::RouteBackendOrders) ?>"> <i class="fa fa-shopping-cart"></i> Orders </a>
                        </li>
                        <?php endif;?>


                    </ul>
                </nav>
            </div>

        </aside>
        <div class="sidebar-overlay" id="sidebar-overlay"></div>

        <article class="content items-list-page">
            <?php
            if (!session_id()) @session_start();
            $flashMessage = new \Plasticbrain\FlashMessages\FlashMessages();
            $flashMessage->display();
            ?>

            <?= $content ?>

        </article>

        <footer class="footer">
            <div class="footer-block author">
               <!-- <ul>
                    <li> created by <a href="#">My eStore</a> </li>
                    <li> <a href="#">get in touch</a> </li>
                </ul>-->
            </div>
        </footer>

        <div class="modal fade" id="modal-media">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Media Library</h4> </div>
                    <div class="modal-body modal-tab-container">
                        <ul class="nav nav-tabs modal-tabs" role="tablist">
                            <li class="nav-item"> <a class="nav-link" href="#gallery" data-toggle="tab" role="tab">Gallery</a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="#upload" data-toggle="tab" role="tab">Upload</a> </li>
                        </ul>
                        <div class="tab-content modal-tab-content">
                            <div class="tab-pane fade" id="gallery" role="tabpanel">
                                <div class="images-container">
                                    <div class="row"> </div>
                                </div>
                            </div>
                            <div class="tab-pane fade active in" id="upload" role="tabpanel">
                                <div class="upload-container">
                                    <div id="dropzone">
                                        <form action="/" method="POST" enctype="multipart/form-data" class="dropzone needsclick dz-clickable" id="demo-upload">
                                            <div class="dz-message-block">
                                                <div class="dz-message needsclick"> Drop files here or click to upload. </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="button" class="btn btn-primary">Insert Selected</button> </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="confirm-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title"><i class="fa fa-warning"></i> Alert</h4> </div>
                    <div class="modal-body">
                        <p>Are you sure want to do this?</p>
                    </div>
                    <div class="modal-footer"> <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button> <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button> </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
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