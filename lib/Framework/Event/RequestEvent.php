<?php

/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/1/2016
 * Time: 7:11 AM
 */
namespace Framework\Event;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\Event;

class RequestEvent extends Event
{
    protected $request;

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }
}