<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/3/2016
 * Time: 4:37 PM
 */

use Framework\TinyMvc;
?>


<section class="section">
    <div class="row sameheight-container">

        <div class="col col-xs-12 history-col">
            <div class="card sameheight-item" data-exclude="xs">
                <div class="card-header card-header-sm bordered">
                    <div class="header-block">
                        <h3 class="title">Store Configuration</h3> </div>
                    <ul class="nav nav-tabs pull-right" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#basic" role="tab" data-toggle="tab">Basic Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#theme" role="tab" data-toggle="tab">Theme Setting</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#sliders" role="tab" data-toggle="tab">Slider</a>
                        </li>
                    </ul>
                </div>

                <div class="card-block">
                    <div class="tab-content" style="height: 400px;">

                        <div role="tabpanel" class="tab-pane active fade in" id="basice">
                            <p class="title-description">Store information</p>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="theme">
                            <?php /** @var $store \Models\Store */ ?>

                            <p class="title-description">Theme selection and customization </p>
                            <hr/>

                            <form method="post" action="<?= TinyMvc::toRoute('settings_change_theme') ?>">
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">
                                        Store Theme:
                                    </label>

                                    <div class="col-sm-10">
                                        <select required name="theme" class="c-select form-control boxed">
                                            <option value="">Select Theme</option>
                                            <?php foreach($themes as $key=>$value):
                                                ?>
                                                <option value="<?= $key ?>" <?= $currentTheme == $key?'selected':''?> >
                                                    <?= $value?>
                                                </option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label text-xs-right">
                                        Header color:
                                    </label>
                                    <div class="col-sm-10">
                                        <input required name="hColor" value="<?= $store->getHeaderColor() ?>" type="color" class="form-control boxed"></div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label text-xs-right">
                                        Footer color:
                                    </label>
                                    <div class="col-sm-10"><input required name="fColor" value="<?= $store->getFooterColor() ?>" type="color" class="form-control boxed"></div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label text-xs-right">
                                        Bottom color:
                                    </label>
                                    <div class="col-sm-10"><input required name="bColor" value="<?= $store->getBottomColor() ?>" type="color" class="form-control boxed"></div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10 col-sm-offset-2">
                                        <button type="submit" class="btn btn-primary">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="sliders">
                            <p class="title-description"> Front page slider settings</p>

                            <button type="button" class="btn btn-primary btn-sm rounded-s pull-right" data-toggle="modal" data-target="#newSliderModal">
                                Add New
                            </button>


                            <section class="example">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $no = 0;
                                    foreach($sliders as $slider){
                                        /** @var $slider \Models\Slider */
                                        ?>
                                        <tr>
                                            <th scope="row"><?= (++$no) ?></th>
                                            <td><?= $slider->getTitle() ?></td>
                                            <td><?= $slider->getShortInfo() ?></td>
                                            <td>
                                                <a class="btn btn-danger" href="<?= TinyMvc::toRoute('settings_delete_slider', ['id' => $slider->getId()])?>">Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                    </tbody>
                                </table>
                            </section>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- Modal -->
<div id="newSliderModal" class="modal fade" role="dialog">
    <div class="modal-dialog">


        <form name="item" method="post" enctype="multipart/form-data"
              action="<?= TinyMvc::toRoute('settings_add_slider') ?>">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Slider</h4>
                </div>
                <div class="modal-body">


                        <div class="card card-block">
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label text-xs-right">
                                    Title:
                                </label>

                                <div class="col-sm-10">
                                    <input required name="title" type="text" class="form-control boxed" placeholder="Caption for the slider">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label text-xs-right">
                                    Short Info:
                                </label>

                                <div class="col-sm-10">
                                    <input required name="short_info" type="text" class="form-control boxed" placeholder="Caption for the slider">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label text-xs-right">
                                    Body:
                                </label>

                                <div class="col-sm-10">
                                    <input required name="body" type="text" class="form-control boxed" placeholder="Caption for the slider">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label text-xs-right">
                                    Sort Order:
                                </label>

                                <div class="col-sm-10">
                                    <input required name="sort_order" type="number" value="0" class="form-control boxed" placeholder="Order of preference">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label text-xs-right">
                                    Image:
                                </label>

                                <div class="col-sm-10">
                                    <input required name="image" type="file" class="form-control boxed">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label text-xs-right">
                                    Image 2:
                                </label>

                                <div class="col-sm-10">
                                    <input name="image2" type="file" class="form-control boxed">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label text-xs-right">
                                    Landing:
                                </label>

                                <div class="col-sm-10">
                                    <input required name="landing_page" type="text" class="form-control boxed" placeholder="Landing page">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label text-xs-right">
                                    Action Text:
                                </label>

                                <div class="col-sm-10">
                                    <input required name="action_text" type="text" class="form-control boxed" placeholder="Action Text">
                                </div>
                            </div>

                        </div>



                </div>

        <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Create</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>


        </form>
    </div>
</div>
