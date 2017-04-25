<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/1/2016
 * Time: 9:12 AM
 */
/**
 * @param $data
 * @param null $message
 */
function dd($data, $message = null){
    var_dump($data);
    die("<br/>$message");
}