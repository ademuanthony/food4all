<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/3/2016
 * Time: 9:21 PM
 */

namespace Controllers;

use Framework\TinyMvc;

class FrontendBaseController extends BaseController
{
    protected function getLayoutFile()
    {
        return 'materialize_front.php'; 'food_'.parent::getLayoutFile();
    }

    protected function getViewFullPath()
    {
        $path = TinyMvc::$config['root'].'/'.$this->viewPath.'/themes/'.$this->store->getTheme().'/'.$this->getViewInnerFolder();
        return $path;
    }
}