<?php
/**
 * A HTTP response type
 */

namespace library\Response;

use library\Response\ResponseInterface as ResponseInterface;

class HttpResponse implements ResponseInterface
{
    /**
     * @var
     */
    private $_version;

    /**
     * @var array
     */
    private $_headers = array();

    private $_headersSent = false;

    /**
     * @param $version
     */
    public function __construct($version)
    {
        if(isset($version))
            $this->_version = $version;
    }

    /**
     * @param $header
     * @param null $key
     */
    public function addHeader($header, $key = null)
    {
        if($key != null)
            $this->_headers[$key] = $header;
        else
            $this->_headers[] = $header;
    }

    /**
     * @param array $headers
     */
    public function addHeaders(array $headers)
    {
        foreach($headers as $header)
            $this->addHeader($header);
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->_headers;
    }

    /**
     * send headers
     */
    public function send()
    {
        if(!$this->_headersSent) {
            foreach($this->_headers as $header) {
                header($this->_version . " $header", true);
            }
            $this->_headersSent = true;
        }
    }
}