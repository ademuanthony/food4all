<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 12/3/2016
 * Time: 12:02 AM
 */

namespace Controllers\Backend;


use Controllers\BaseController;

class BackendBaseController extends BaseController
{

    protected function getLayoutFile()
    {
        return 'materialize_main.php';
    }
}