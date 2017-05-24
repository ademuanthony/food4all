<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/2/2016
 * Time: 11:26 PM
 */
/** @var $eventType Models\EventType */
?>

<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
    <div class="container">
        <div class="row">
            <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Add new event type</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?= \Framework\TinyMvc::toRoute(\Globals\AppService::RouteBackendDashboard) ?>">Dashboard</a></li>
                    <li><a href="<?= \Framework\TinyMvc::toRoute(\Globals\AppService::RouteBackendEarningEventType) ?>">Event Types</a></li>
                    <li class="active">Add Earning Event Type</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs end-->

<section class="section">
    <div class="row">
        <div class="col s12">
            <form name="item" method="post" enctype="multipart/form-data">
                <div class="card card-block">
                    <div class="row">
                        <div class="input-field col s12">
                            <input required name="name" value="<?= $eventType->getName() ?>" type="text" class="form-control boxed">
                            <label for="name">Name</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input required name="key" value="<?= $eventType->getKey() ?>" type="text" class="form-control boxed">
                            <label for="name">Key</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <textarea required name="description" class="form-control boxed materialize-textarea"><?= $eventType->getDescription() ?></textarea>
                            <label for="description">Description</label>
                        </div>
                    </div>



                    <div class="row">
                        <div class="input-field col s12">
                            <select required name="stage_id" class="c-select form-control boxed">
                                <option value="">Select Stage</option>
                                <?php foreach($stages as $stage):
                                    /** @var $stage Models\MatrixStage */
                                    ?>
                                    <option value="<?= $stage->getId() ?>" <?= $eventType->getStageId() == $stage->getId()?'selected':''?> ><?= $stage->getLabel()?></option>
                                <?php endforeach;?>
                            </select>
                            <label for="category_id">Stage</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input required name="descendants_count" value="<?= $eventType->getDescendantsCount() ?>"
                                   type="text" class="form-control boxed">
                            <label for="descendants_count">Descendants Count</label>
                        </div>
                    </div>



                    <div class="row">
                        <div class="input-field col s12">
                            <input required name="reward" value="<?= $eventType->getReward() ?>"
                                   type="text" class="form-control boxed">
                            <label for="reward">Reward</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input required name="cash_percentage" value="<?= $eventType->getCashPercentage() ?>"
                                   type="text" class="form-control boxed">
                            <label for="cash_percentage">Cash Percentage</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input required name="food_percentage" value="<?= $eventType->getFoodPercentage() ?>"
                                   type="text" class="form-control boxed">
                            <label for="food_percentage">Food Percentage</label>
                        </div>
                    </div>



                    <div class="row">
                        <div class="input-field col s12">
                            <input required name="sponsors_reward" value="<?= $eventType->getSponsorsReward() ?>" type="text" class="form-control boxed">
                            <label for="sponsors_reward">Sponsor's Reward</label>
                        </div>
                    </div>



                    <div class="form-group row">
                        <div class="col s12 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
