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
                <h5 class="breadcrumbs-title">Fund Transfer</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?= \Framework\TinyMvc::toRoute(\Globals\AppService::RouteBackendDashboard) ?>">Dashboard</a></li>
                    <li class="active">Transfers</li>
                </ol>
            </div>

            <div class="col s2 m2 l2">
                <a style="margin-top: 20px;" href="#sendMoney" data-toggle="modal" data-target="#sendMoney" class="btn btn-primary modal-trigger waves-effect waves-light">Send Money</a>
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
                    <th>From</th>
                    <th>To</th>
                    <th>Date</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>


                <?php $no = $page_info->off_set;
                foreach($page_info->data as $transfer){
                    /** @var $transfer array */
                    ?>
                    <tr>
                        <th scope="row"><?= (++$no) ?></th>
                        <td><?= $transfer['s_firstname']. ' '.$transfer['s_lastname'] ?></td>
                        <td><?= $transfer['r_firstname']. ' '.$transfer['r_lastname'] ?></td>
                        <td><?= $transfer['date'] ?></td>
                        <td><?= $transfer['amount'] ?></td>
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

<!-- Modal -->
<div id="sendMoney" class="modal fade" role="dialog">
    <nav class="task-modal-nav red">
        <div class="nav-wrapper">
            <div class="left col s12 m5 l5">
                <ul>
                    <li>
                        <a href="#!" class="todo-menu">
                            <i class="modal-action modal-close  mdi-hardware-keyboard-backspace"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="modal-content">

        <form method="post" action="<?= TinyMvc::toRoute(AppService::SendMoney) ?>">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Transfer Fund</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="input-field col s6">
                            <input placeholder="Receiver Id" id="receiver_id" name="receiver_id" type="text" class="validate">
                            <label for="receiver_id" class="active">Receiver ID</label>
                        </div>
                        <div class="input-field col s6">
                            <span id="receiver_name"></span>
                            <button id="btn_check" class="btn">Validate</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="Amount" id="amount" name="amount" type="text" class="validate">
                            <label for="email">Amount</label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="modal-action modal-close btn btn-default" data-dismiss="modal">Close</button>-->
                    <button type="submit" class="btn btn-default green">Send</button>
                </div>
            </div>

        </form>

    </div>
</div>

