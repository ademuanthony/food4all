<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 10/5/2016
 * Time: 7:19 AM
 */

namespace Controllers\Users;


use Globals\Utility;

class DashboardController extends UsersBaseController
{
    public function indexAction(){
        dd(Utility::getInstance()->getCurrentUser());
        return $this->render('index');
    }
}