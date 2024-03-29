<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/3/2016
 * Time: 8:12 AM
 */

namespace Framework\Http;



class Header implements \Countable
{
    protected static $messages = array(
        // Informational 1xx
        100 => 'Continue',
        101 => 'Switching Protocols',

        // Success 2xx
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',

        // Redirection 3xx
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found', // 1.1
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        // 306 is deprecated but reserved
        307 => 'Temporary Redirect',

        // Client Error 4xx
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',

        // Server Error 5xx
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        509 => 'Bandwidth Limit Exceeded'
    );

    private $fields = array();
    public $version = '1.0';
    public $statusCode = 0;
    public $statusMessage = '';
    public $status = '';

    const BUILD_STATUS = 1;
    const BUILD_FIELDS = 2;

    public function set($name, $value)
    {
        $this->fields[$name] = $value;
    }

    public function setMultiple($fields)
    {
        $this->fields = $fields;
    }

    public function addMultiple($fields)
    {
        $this->fields = array_combine($this->fields, $fields);
    }

    public function get($name)
    {
        return $this->fields[$name];
    }

    public function getAll()
    {
        return $this->fields;
    }

    /**
     * Determine if a header exists with a specific key.
     *
     * @param string $name Key to lookup.
     *
     * @return boolean
     */
    public function has($name)
    {
        foreach ($this->getAll() as $key => $value) {
            if (0 === strcmp(strtolower($key), strtolower($name))) {
                return true;
            }
        }
        return false;
    }

    public function remove($name)
    {
        unset($this->fields[$name]);
    }

    public function parse($content)
    {
        if (empty($content)) {
            return false;
        }

        if (is_string($content)) {
            $content = array_filter(explode("\r\n", $content));
        } elseif (!is_array($content)) {
            return false;
        }

        $status = array();
        if (preg_match('/^HTTP\/(\d(?:\.\d)?)\s+(\d{3})\s+(.+)$/i', $content[0], $status)) {
            $this->status = array_shift($content);
            $this->version = $status[1];
            $this->statusCode = intval($status[2]);
            $this->statusMessage = $status[3];
        }

        foreach ($content as $field) {
            if (!is_array($field)) {
                $field = array_map('trim', explode(':', $field, 2));
            }

            if (count($field) == 2) {
                $this->set($field[0], $field[1]);
            }
        }

        return true;
    }

    public function build($flags = 0)
    {
        $lines = array();
        if (($flags & self::BUILD_STATUS) && !empty(self::$messages[$this->statusCode])) {
            $lines[] = 'HTTP/' . $this->version . ' ' .
                $this->statusCode . ' ' .
                self::$messages[$this->statusCode];
        }

        foreach ($this->fields as $field => $value) {
            $lines[] = $field . ': ' . $value;
        }

        if ($flags & self::BUILD_FIELDS) {
            return implode("\r\n", $lines);
        }

        return $lines;
    }

    public function count()
    {
        return count($this->fields);
    }
}