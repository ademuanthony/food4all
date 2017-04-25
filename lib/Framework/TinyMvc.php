<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/1/2016
 * Time: 12:23 PM
 */

namespace Framework;


use Globals\Utility;

class TinyMvc
{
    /** @var array */
    public static $config = array();

    /** @var Core  */
    public static $app = null;

    public static function toRoute($path, array $param = array()){
        return self::$app->generateUrl($path, $param);
    }

    public static function isDevEnv(){
        return self::$config['env'] == 'dev';
    }


}