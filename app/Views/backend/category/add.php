<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/2/2016
 * Time: 11:26 PM
 */
    /** @var $category Models\Category */
?>

<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
    <div class="container">
        <div class="row">
            <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Add new category</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?= \Framework\TinyMvc::toRoute(\Globals\AppService::RouteBackendDashboard) ?>">Dashboard</a></li>
                    <li><a href="<?= \Framework\TinyMvc::toRoute(\Globals\AppService::RouteBackendCategories) ?>">Categories</a></li>
                    <li class="active">Add category</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs end-->

<section class="sesction">
    <div class="row">
        <div class="col s12">

            <form name="item" method="post" enctype="multipart/form-data">
                <div class="card card-block">
                    <div class="row">
                        <div class="input-field col s12">
                            <input required name="name" value="<?= $category->getName() ?>" type="text" class="form-control boxed" placeholder="">
                            <label for="first_name">Name</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input title="Page title" required name="permalink" value="<?= $category->getPermalink() ?>" type="text" class="form-control boxed" placeholder="">
                            <label for="permalink">Permalink</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <textarea required name="description" class="form-control boxed materialize-textarea"><?= $category->getDescription() ?></textarea>
                            <label for="description">Description</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input title="Keywordss for search engine optimisation" name="keywords" value="<?= $category->getKeywords() ?>" type="text" class="form-control boxed" placeholder="E.g. rice, yam, ...">
                            <label for="keywords">Keywords</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input title="Search engine description" name="meta_description" value="<?= $category->getMetaDescription() ?>" type="text" class="form-control boxed" placeholder="">
                            <label for="meta_description">Meta Description</label>
                        </div>
                    </div>


                    <div class="row">
                        <div class="input-field col s12">
                            <select name="parent_id" class="c-select form-control boxed">
                                <option value="">Select Category</option>
                                <?php foreach($categories as $cat):
                                    /** @var $cat Models\Category */
                                    ?>
                                    <option value="<?= $cat->getId() ?>" <?= $category->getParentId() == $cat->getId()?'selected':''?> ><?= $cat->getName()?></option>
                                <?php endforeach;?>
                            </select>
                            <label for="parent_id">Parent Category</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10 col-sm-offset-2">
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
