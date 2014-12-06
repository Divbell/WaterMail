<?php
/**
 * A route class - single object of route
 */

namespace library\Routing;

use library\Request\HttpRequest;

class Route
{
    /**
     * @var
     */
    private $_uri;

    /**
     * @var
     */
    private $_controllerName;

    /**
     * @var
     */
    private $_actionName;

    /**
     * @param array $routeData
     * @param $uri
     */
    public function __construct(array $routeData, $uri)
    {
        $this->_uri = $uri;
        $this->_controllerName = $routeData['controller'];
        $this->_actionName = $routeData['action'];
    }

    /**
     * @param HttpRequest $request
     * @return bool
     */
    public function match(HttpRequest $request)
    {
        return ($this->_uri == $request->getUri() ? true : false);
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->_uri;
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->_controllerName;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->_actionName;
    }
}