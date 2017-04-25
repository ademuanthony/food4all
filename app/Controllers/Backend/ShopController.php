<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/22/2016
 * Time: 7:06 PM
 */

namespace Controllers\Backend;


use Controllers\BaseController;

class ShopController extends BackendBaseController
{
    public function IndexAction(){
        return $this->render('index');
    }
}