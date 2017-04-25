<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/5/2016
 * Time: 4:08 AM
 */

namespace Controllers;


class CategoryController extends FrontendBaseController
{
    public function IndexAction($permalink){
        return $this->render('index');
    }
}