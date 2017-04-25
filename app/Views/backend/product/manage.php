<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/2/2016
 * Time: 11:26 PM
 */
/** @var $product Models\Product */
?>

<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
    <div class="container">
        <div class="row">
            <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Manage product</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?= \Framework\TinyMvc::toRoute(\Globals\AppService::RouteBackendDashboard) ?>">Dashboard</a></li>
                    <li><a href="<?= \Framework\TinyMvc::toRoute(\Globals\AppService::RouteBackendProducts) ?>">Products</a></li>
                    <li class="active">Manage product</li>
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
                    <input type="hidden" name="id" value="<?= $product->getId() ?>">
                    <div class="row">
                        <div class="input-field col s12">
                            <input required name="name" value="<?= $product->getName() ?>" type="text" class="form-control boxed">
                            <label for="name">Name</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input required name="quantity" value="<?= $product->getQuantity() ?>" type="number" class="form-control boxed">
                            <label for="quantity">Quantity</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input required name="permalink" value="<?= $product->getPermalink() ?>" type="text" class="form-control boxed" placeholder="">
                            <label for="permalink">Permalink</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input required name="weight" value="<?= $product->getWeight() ?>" type="text" class="form-control boxed">
                            <label for="permalink">Weight</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input name="image" type="file" class="form-control boxed">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <textarea required name="description" class="form-control boxed materialize-textarea"><?= $product->getDescription() ?></textarea>
                            <label for="permalink">Description</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input required name="old_price" value="<?= $product->getOldPrice() ?>" type="text" class="form-control boxed" placeholder="">
                            <label for="permalink">Price</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input required name="new_price" value="<?= $product->getNewPrice() ?>" type="text" class="form-control boxed">
                            <label for="permalink">New Price</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input name="keywords" value="<?= $product->getKeywords() ?>" type="text" class="form-control boxed" placeholder="E.g. rice,yam,free rice">
                            <label for="keywords">Keywords</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input name="meta_description" value="<?= $product->getMetaDescription() ?>" type="text" class="form-control boxed">
                            <label for="keywords">Meta Description</label>
                        </div>
                    </div>


                    <div class="row">
                        <div class="input-field col s12">
                            <select required name="category_id" class="c-select form-control boxed">
                                <option value="">Select Category</option>
                                <?php foreach($categories as $cat):
                                    /** @var $cat Models\Category */
                                    ?>
                                    <option value="<?= $cat->getId() ?>" <?= $product->getCategoryId() == $cat->getId()?'selected':''?> ><?= $cat->getName()?></option>
                                <?php endforeach;?>
                            </select>
                            <label for="category_id">Category</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">
                            <input id="is_featured" name="is_featured" value="1" <?= $product->getIsFeatured()?'checked':'' ?> type="checkbox">
                            <label for="is_featured">Is Featured</label>

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



