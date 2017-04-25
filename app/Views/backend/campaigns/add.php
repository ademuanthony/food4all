<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/2/2016
 * Time: 11:26 PM
 */
/** @var $campaign Models\Campaign */
?>

<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
    <div class="container">
        <div class="row">
            <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Add new product</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?= \Framework\TinyMvc::toRoute(\Globals\AppService::RouteBackendDashboard) ?>">Dashboard</a></li>
                    <li><a href="<?= \Framework\TinyMvc::toRoute(\Globals\AppService::BackendCampaigns) ?>">Campaigns</a></li>
                    <li class="active">Add campaigns</li>
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
                            <input required name="title" value="<?= $campaign->getTitle() ?>" type="text" class="form-control boxed">
                            <label for="name">Title</label>
                        </div>
                    </div>


                    <div class="row">
                        <div class="input-field col s12">
                            <input name="image" type="file" class="form-control boxed">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <textarea required name="content" class="form-control boxed materialize-textarea"><?= $campaign->getContent() ?></textarea>
                            <label for="permalink">Content</label>
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
