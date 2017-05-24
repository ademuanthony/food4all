<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/2/2016
 * Time: 11:26 PM
 */

/** @var PageInfo $page_info */

use Framework\TinyMvc;
use Framework\Pagination\PageInfo;
use Globals\AppService;
?>

<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
    <div class="container">
        <div class="row">
            <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Earning Events</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?= \Framework\TinyMvc::toRoute(\Globals\AppService::RouteBackendDashboard) ?>">Dashboard</a></li>
                    <li class="active">Earning Events</li>
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
                    <th>Key</th>
                    <th>Name</th>
                    <th>Descendants Count</th>
                    <th>Reward</th>
                    <th>Stage</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>


                <?php $no = $page_info->off_set;
                foreach($page_info->data as $eventType){
                    /** @var $eventType \Models\EventType */
                    ?>
                    <tr>
                        <th scope="row"><?= (++$no) ?></th>
                        <td><?= $eventType->getKey() ?></td>
                        <td><?= $eventType->getName() ?></td>
                        <td><?= $eventType->getDescendantsCount() ?></td>
                        <td><?= $eventType->getReward() ?></td>
                        <td><?= $eventType->getStageId() ?></td>
                        <td>
                            <a class="btn btn-success" href="<?= TinyMvc::toRoute(AppService::RouteBackendManageEarningEventType, ['id' => $eventType->getId()]) ?>">Edit</a>
                            <a class="btn btn-danger" href="<?= TinyMvc::toRoute(AppService::RouteBackendDeleteEarningEventType, ['id' => $eventType->getId()]) ?>">Delete</a>
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

<!-- Floating Action Button -->
<div class="fixed-action-btn" style="bottom: 50px; right: 19px;">
    <a class="btn-floating btn-large">
        <i class="mdi-action-stars"></i>
    </a>
    <ul>
        <li><a title="Add Event Type" href="<?= TinyMvc::toRoute(AppService::RouteBackendAddEarningEventType) ?>"
               class="btn-floating red"><i class="large mdi-content-add"></i></a></li>
    </ul>
</div>
<!-- Floating Action Button -->

<?php if($page_info->hasRecord()):?>

    <div class="row">
        <div class="col s5">
            <p><?=$page_info->pageDetail()?> </p>
        </div>
        <div class="col s7">

            <ul class="pagination">
                <li class="<?= $page_info->isFirstPage()? 'disabled' :'waves-effect' ?>"><a href="?page=<?=($page_info->page-1)?>"><i class="mdi-navigation-chevron-left"></i></a></li>
                <?php foreach($page_info->getPages() as $page):?>
                    <li class="<?=$page_info->isCurrentPage($page)?'active':'waves-effect'?>"> <a class="page-link" href="?page=<?=$page?>">
                            <?=$page?>
                        </a>
                    </li>
                <?php endforeach;?>

                <li class="<?= $page_info->isLastPage()?'disabled':'waves-effect'?>"><a href="?page=<?=($page_info->page+1)?>"><i class="mdi-navigation-chevron-right"></i></a></li>
            </ul>

        </div>
    </div>

<?php endif;?>
