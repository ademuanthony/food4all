<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/3/2016
 * Time: 8:19 AM
 */

namespace Framework\Http\Client\Provider;


use Framework\Http\Client\Exception as HttpException;
use Framework\Http\Client\Provider\Exception as ProviderException;
use Framework\Http\Client\Request;
use Framework\Http\Client\Response;

class Curl extends Request
{
    private $handle = null;

    public static function isAvailable()
    {
        return extension_loaded('curl');
    }

    public function __construct()
    {
        if (!self::isAvailable()) {
            throw new ProviderException('CURL extension is not loaded');
        }

        $this->handle = curl_init();
        $this->initOptions();
        parent::__construct();
    }

    public function __destruct()
    {
        curl_close($this->handle);
    }

    public function __clone()
    {
        $request = new self;
        $request->handle = curl_copy_handle($this->handle);

        return $request;
    }

    private function initOptions()
    {
        $this->setOptions(array(
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_AUTOREFERER     => true,
            CURLOPT_FOLLOWLOCATION  => true,
            CURLOPT_MAXREDIRS       => 20,
            CURLOPT_HEADER          => true,
            CURLOPT_PROTOCOLS       => CURLPROTO_HTTP | CURLPROTO_HTTPS,
            CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTP | CURLPROTO_HTTPS,
            CURLOPT_USERAGENT       => 'Phalcon HTTP/' . self::VERSION . ' (Curl)',
            CURLOPT_CONNECTTIMEOUT  => 30,
            CURLOPT_TIMEOUT         => 30,
            CURLOPT_SSL_VERIFYPEER => false //to be removed
        ));


        //curl_setopt($s, CURLOPT_SSL_VERIFYPEER, false);
    }

    public function setOption($option, $value)
    {
        return curl_setopt($this->handle, $option, $value);
    }

    public function setOptions($options)
    {
        return curl_setopt_array($this->handle, $options);
    }

    public function setTimeout($timeout)
    {
        $this->setOption(CURLOPT_TIMEOUT, $timeout);
    }

    public function setConnectTimeout($timeout)
    {
        $this->setOption(CURLOPT_CONNECTTIMEOUT, $timeout);
    }

    private function send($customHeader = array(), $fullResponse = false)
    {
        if (!empty($customHeader)) {
            $header = $customHeader;
        } else {
            $header = array();
            if (count($this->header) > 0) {
                $header = $this->header->build();
            }
            $header[] = 'Expect:';
        }

        $this->setOption(CURLOPT_HTTPHEADER, $header);

        $content = curl_exec($this->handle);

        if ($errno = curl_errno($this->handle)) {
            throw new HttpException(curl_error($this->handle), $errno);
        }

        $headerSize = curl_getinfo($this->handle, CURLINFO_HEADER_SIZE);

        $response = new Response();
        $response->header->parse(substr($content, 0, $headerSize));

        if ($fullResponse) {
            $response->body = $content;
        } else {
            $response->body = substr($content, $headerSize);
        }

        return $response;
    }

    /**
     * Prepare data for a cURL post.
     *
     * @param mixed   $params      Data to send.
     * @param boolean $useEncoding Whether to url-encode params. Defaults to true.
     *
     * @return void
     */
    private function initPostFields($params, $useEncoding = true)
    {
        if (is_array($params)) {
            foreach ($params as $param) {
                if (is_string($param) && preg_match('/^@/', $param)) {
                    $useEncoding = false;
                    break;
                }
            }

            if ($useEncoding) {
                $params = http_build_query($params);
            }
        }

        if (!empty($params)) {
            $this->setOption(CURLOPT_POSTFIELDS, $params);
        }
    }

    public function setProxy($host, $port = 8080, $user = null, $pass = null)
    {
        $this->setOptions(array(
            CURLOPT_PROXY     => $host,
            CURLOPT_PROXYPORT => $port
        ));

        if (!empty($user) && is_string($user)) {
            $pair = $user;
            if (!empty($pass) && is_string($pass)) {
                $pair .= ':' . $pass;
            }
            $this->setOption(CURLOPT_PROXYUSERPWD, $pair);
        }
    }

    public function get($uri, $params = array(), $customHeader = array(), $fullResponse = false)
    {
        $uri = $this->resolveUri($uri);

        if (!empty($params)) {
            $uri->extendQuery($params);
        }

        $this->setOptions(array(
            CURLOPT_URL           => $uri->build(),
            CURLOPT_HTTPGET       => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ));

        return $this->send($customHeader, $fullResponse);
    }

    public function head($uri, $params = array(), $customHeader = array(), $fullResponse = false)
    {
        $uri = $this->resolveUri($uri);

        if (!empty($params)) {
            $uri->extendQuery($params);
        }

        $this->setOptions(array(
            CURLOPT_URL           => $uri->build(),
            CURLOPT_HTTPGET       => true,
            CURLOPT_CUSTOMREQUEST => 'HEAD'
        ));

        return $this->send($customHeader, $fullResponse);
    }

    public function delete($uri, $params = array(), $customHeader = array(), $fullResponse = false)
    {
        $uri = $this->resolveUri($uri);

        if (!empty($params)) {
            $uri->extendQuery($params);
        }

        $this->setOptions(array(
            CURLOPT_URL           => $uri->build(),
            CURLOPT_HTTPGET       => true,
            CURLOPT_CUSTOMREQUEST => 'DELETE'
        ));

        return $this->send($customHeader, $fullResponse);
    }

    public function post($uri, $params = array(), $useEncoding = true, $customHeader = array(), $fullResponse = false)
    {
        $this->setOptions(array(
            CURLOPT_URL           => $this->resolveUri($uri),
            CURLOPT_POST          => true,
            CURLOPT_CUSTOMREQUEST => 'POST'
        ));

        $this->initPostFields($params, $useEncoding);

        return $this->send($customHeader, $fullResponse);
    }

    public function put($uri, $params = array(), $useEncoding = true, $customHeader = array(), $fullResponse = false)
    {
        $this->setOptions(array(
            CURLOPT_URL           => $this->resolveUri($uri),
            CURLOPT_POST          => true,
            CURLOPT_CUSTOMREQUEST => 'PUT'
        ));

        $this->initPostFields($params, $useEncoding, $customHeader);

        return $this->send($customHeader, $fullResponse);
    }
}