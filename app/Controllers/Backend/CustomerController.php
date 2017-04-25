<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/3/2016
 * Time: 4:46 PM
 */

namespace Controllers\Backend;


use Controllers\BaseController;

class CustomerController extends BackendBaseController
{
    public function IndexAction(){
        return $this->render('index', ['layout' => ['title' => 'Customers']]);
    }
}