<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/3/2016
 * Time: 8:10 AM
 */

namespace Framework\Http\Client;

class HttpClient
{

    private $provider;


    function __construct()
    {
        $this->provider = Request::getProvider();
    }

    public function set($key, $value)
    {
        $this->provider->header->set($key, $value);
    }

    public function get($url, $convert_to_array = false)
    {
        $response = $this->provider->get($url);
        return json_decode($response->body, $convert_to_array);
    }


    public function post($url, $data, $convert_to_array = false)
    {
        $response = $this->provider->post($url, $data);
        return json_decode($response->body, $convert_to_array);
    }

    public function put($url, $data, $convert_to_array = false)
    {
        $response = $this->provider->put($url, $data);
        return json_decode($response->body, $convert_to_array);
    }

    public function delete($url, $convert_to_array = false)
    {
        $response = $this->provider->delete($url);
        return json_decode($response->body, $convert_to_array);
    }


}