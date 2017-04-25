<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/17/2016
 * Time: 5:28 AM
 */

/** @var $member \Models\Member */
/** @var $tree \Models\Tree */
/** @var $type String */
?>


<!-- tree -->
<style type="text/css">
    ul.tree {
        overflow-x: auto;
        white-space: nowrap;
    }
    ul.tree,
    ul.tree ul {
        width: auto;
        margin: 0;
        padding: 0;
        list-style-type: none;
    }
    ul.tree li {
        display: block;
        width: auto;
        float: left;
        vertical-align: top;
        padding: 0;
        margin: 0;
    }
    ul.tree ul li {
        background-image: url(data:image/gif;base64,R0lGODdhAQABAIABAAAAAP///ywAAAAAAQABAAACAkQBADs=);
        background-repeat: repeat-x;
        background-position: left top;
    }
    ul.tree li span {
        display: block;
        width: 5em;
        /*
          uncomment to fix levels
          height: 1.5em;
        */
        margin: 0 auto;
        text-align: center;
        white-space: normal;
        letter-spacing: normal;
    }
</style>
<!--[if IE gt 8]> IE 9+ and not IE -->
<style type="text/css">
    ul.tree ul li:last-child {
        background-repeat: no-repeat;
        background-size:50% 1px;
        background-position: left top;
    }
    ul.tree ul li:first-child {
        background-repeat: no-repeat;
        background-size: 50% 1px;
        background-position: right top;
    }
    ul.tree ul li:first-child:last-child {
        background: none;
    }
    ul.tree ul li span {
        background: url(data:image/gif;base64,R0lGODdhAQABAIABAAAAAP///ywAAAAAAQABAAACAkQBADs=) no-repeat 50% top;
        background-size: 1px 0.8em;
        padding-top: 1.2em;
    }
    ul.tree ul {
        background: url(data:image/gif;base64,R0lGODdhAQABAIABAAAAAP///ywAAAAAAQABAAACAkQBADs=) no-repeat 50% top;
        background-size: 1px 0.8em;
        margin-top: 0.2ex;
        padding-top: 0.8em;
    }
</style>
<!-- <[endif]-->
<!--[if lte IE 8]>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript">
    /* Just to simplify HTML for the moment.
     * This could easily be replaced by inline classes.
     */
    $(function() {
      $('li:first-child').addClass('first');
      $('li:last-child').addClass('last');
      $('li:first-child:last-child').addClass('lone');
    });
</script>
<style type="text/css">
ul.tree ul li {
  background-image: url(pixel.gif);
}
ul.tree ul li.first {
  background-image: url(left.gif);
  background-position: center top;
}
ul.tree ul li.last {
  background-image: url(right.gif);
  background-position: center top;
}
ul.tree ul li.lone {
  background: none;
}
ul.tree ul li span {
  background: url(child.gif) no-repeat 50% top;
  padding-top: 14px;
}
ul.tree ul {
  background: url(child.gif) no-repeat 50% top;
  margin-top: 0.2ex;
  padding-top: 11px;
}
</style>
<[endif]-->

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
                    <li class="active"><?= ($type == \Models\Tree::TYPE_ALL_DOWNLINE? 'All Downline': $type == \Models\Tree::TYPE_DIRECT_DOWNLINE? 'Direct Downline': 'Personal growth') ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs end-->

<section class="container">
    <div class="row">

        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title"><?= ($type == \Models\Tree::TYPE_ALL_DOWNLINE? 'All Downline': $type == \Models\Tree::TYPE_DIRECT_DOWNLINE? 'Direct Downline': 'Personal growth') ?></span>
                    <div class="row row-sm stats-container" style="overflow: auto;">
                        <div style="width:2500px">
                            <?php $tree->display(); ?>
                        </div>
                        <!--<div style="overflow: auto;" id="chart" class="orgChart"></div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col s12">
            <p><img style="height: 40px; width: 40px;" src="/web/app/images/stage_avatars/stage-1-female.png"> Stage 1
                <img style="height: 40px; width: 40px;" src="/web/app/images/stage_avatars/stage-2-male.png"> Stage 2
                <img style="height: 40px; width: 40px;"  src="/web/app/images/stage_avatars/stage-3-male.png"> Stage 3
                <img style="height: 40px; width: 40px;" src="/web/app/images/stage_avatars/stage-4-female.png"> Stage 4
                <img style="height: 40px; width: 40px;" src="/web/app/images/stage_avatars/stage-5-male.png"> Stage 5</p>
        </div>
    </div>


</section>
