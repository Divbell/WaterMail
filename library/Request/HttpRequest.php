<?php
/**
 * A HTTP request class
 */

namespace library\Request;

use library\Request\RequestInterface;

class HttpRequest implements RequestInterface
{
    /**
     * @var
     */
    private $_uri;

    /**
     * @var array
     */
    private $_params = array();


    public function __construct($uri = '')
    {
        if($uri == '') {
            $this->_uri = $_SERVER['REQUEST_URI'];
        } else $this->_uri = $uri;
    }

    /**
     * returns URI of the request object
     * @return mixed
     */
    public function getUri()
    {
        return $this->_uri;
    }
}