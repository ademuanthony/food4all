<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/3/2016
 * Time: 8:18 AM
 */

namespace Framework\Http\Client;


use Framework\Http\Client\Provider\Curl;
use Framework\Http\Client\Provider\Exception as ProviderException;
use Framework\Http\Client\Provider\Stream;
use Framework\Http\Uri;

abstract class Request
{
    protected $baseUri;
    public $header = null;

    const VERSION = '0.0.1';

    public function __construct()
    {
        $this->baseUri = new Uri();
        $this->header = new Header();
    }

    public static function getProvider()
    {
        if (Curl::isAvailable()) {
            return new Curl();
        }

        if (Stream::isAvailable()) {
            return new Stream();
        }

        throw new ProviderException('There isn\'t any available provider');
    }

    public function setBaseUri($baseUri)
    {
        $this->baseUri = new Uri($baseUri);
    }

    public function getBaseUri()
    {
        return $this->baseUri;
    }

    public function resolveUri($uri)
    {
        return $this->baseUri->resolve($uri);
    }
}