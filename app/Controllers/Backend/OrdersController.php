<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/3/2016
 * Time: 4:44 PM
 */

namespace Controllers\Backend;


use Controllers\BaseController;

class OrdersController extends BackendBaseController
{
    public function IndexAction(){
        return $this->render('index', ['layout' => ['title' => 'Orders']]);
    }

}