<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 11/24/2016
 * Time: 5:33 AM
 */
?>

<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
    <!-- Search for small screen -->
    <div class="header-search-wrapper grey hide-on-large-only">
        <form action="<?= \Framework\TinyMvc::toRoute(\Globals\AppService::GenealogySearch) ?>">
            <i class="mdi-action-search active"></i>
            <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
        </form>
    </div>
    <div class="container">
        <div class="row">
            <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Genealogy</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?= \Framework\TinyMvc::toRoute(\Globals\AppService::RouteBackendDashboard) ?>">Dashboard</a></li>
                    <li><a href="<?= \Framework\TinyMvc::toRoute(\Globals\AppService::Genealogy) ?>">Genealogy</a> </li>
                    <li class="active">List of Downlines</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs end-->


<section class="section">
    <div class="row">
        <div class="col s12">
            <table class="table bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Membership Id</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $sn = 0; foreach($downlines as $downline): ?>
                    <tr>
                        <td><?= (++$sn)?></td>
                        <td><?= ucwords($downline['fullname']) ?></td>
                        <td><?= $downline['membership_id'] ?></td>
                        <td><?= $downline['username'] ?></td>
                        <td><a href="<?= \Framework\TinyMvc::toRoute(\Globals\AppService::GenealogySearch, ['membership_id' => $downline['membership_id']]) ?>">View Genealogy</a></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>

    </div>
</section>

<!--
<?php /*if($page_info->hasRecord()):*/?>

    <div class="row">
        <div class="col s5">
            <p><?/*=$page_info->pageDetail()*/?> </p>
        </div>
        <div class="col s7">

            <ul class="pagination">
                <li class="<?/*= $page_info->isFirstPage()? 'disabled' :'waves-effect' */?>"><a href="?page=<?/*=($page_info->page-1)*/?>"><i class="mdi-navigation-chevron-left"></i></a></li>
                <?php /*foreach($page_info->getPages() as $page):*/?>
                    <li class="<?/*=$page_info->isCurrentPage($page)?'active':'waves-effect'*/?>"> <a class="page-link" href="?page=<?/*=$page*/?>">
                            <?/*=$page*/?>
                        </a>
                    </li>
                <?php /*endforeach;*/?>

                <li class="<?/*= $page_info->isLastPage()?'disabled':'waves-effect'*/?>"><a href="?page=<?/*=($page_info->page+1)*/?>"><i class="mdi-navigation-chevron-right"></i></a></li>
            </ul>

        </div>
    </div>

--><?php /*endif;*/?>
