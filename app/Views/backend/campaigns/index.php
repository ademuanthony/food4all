<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/22/2016
 * Time: 6:57 PM
 */

/** @var $page_info Framework\Pagination\PageInfo */
use Framework\TinyMvc;
use Globals\AppService;
?>




<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
    <div class="container">
        <div class="row">
            <div class="col s10 m10 l10">
                <h5 class="breadcrumbs-title">Campaigns Setup</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?= \Framework\TinyMvc::toRoute(\Globals\AppService::RouteBackendDashboard) ?>">Dashboard</a></li>
                    <li class="active">Campaigns</li>
                </ol>
            </div>

            <div class="col s2 m2 l2">
                <a style="margin-top: 20px;" href="<?= TinyMvc::toRoute(AppService::BackendCampaignAdd) ?>"
                   class="btn btn-primary waves-effect waves-light">Add Campaign</a>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs end-->


<section class="example">
    <div class="row">
        <div class="col s12">
            <table class="table bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>


                <?php $no = $page_info->off_set;
                foreach($page_info->data as $campaign){
                    /** @var $campaign \Models\Campaign */
                    ?>
                    <tr>
                        <th scope="row"><?= (++$no) ?></th>
                        <td><?= $campaign->getTitle() ?></td>
                        <td>
                            <a class="btn btn-danger waves-effect waves-light"
                               href="<?= TinyMvc::toRoute(AppService::BackendCampaignDetails,
                                   ['id' => $campaign->getId()]) ?>">View Details</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
</section>

<?php if($page_info->hasRecord()):?>

    <div class="row">
        <div class="col s5">
            <p><?=$page_info->pageDetail()?> </p>
        </div>
        <div class="col s7">

            <ul class="pagination">
                <li class="<?= $page_info->isFirstPage()? 'disabled' :'waves-effect' ?>">
                    <a href="<?=($page_info->isFirstPage()?'#!':'?page='.($page_info->page-1))?>"><i class="mdi-navigation-chevron-left"></i></a></li>
                <?php foreach($page_info->getPages() as $page):?>
                    <li class="<?=$page_info->isCurrentPage($page)?'active':'waves-effect'?>"> <a class="page-link" href="?page=<?=$page?>">
                            <?=$page?>
                        </a>
                    </li>
                <?php endforeach;?>

                <li class="<?= $page_info->isLastPage()?'disabled':'waves-effect'?>">
                    <a href="<?= $page_info->isLastPage()?'#!': '?page='.($page_info->page+1)?>"><i class="mdi-navigation-chevron-right"></i></a></li>
            </ul>

        </div>
    </div>

<?php endif;?>


