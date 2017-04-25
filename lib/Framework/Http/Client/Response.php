<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/3/2016
 * Time: 8:20 AM
 */

namespace Framework\Http\Client;


class Response
{
    public $body = '';
    public $header = null;

    public function __construct()
    {
        $this->header = new Header();
    }
}