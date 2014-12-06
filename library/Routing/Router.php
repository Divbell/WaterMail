<?php
/**
 * A router class
 */

namespace library\Routing;

use library\ConfigReader;
use library\Exceptions\InvalidKeyException;
use library\Request\HttpRequest;

Class Router
{
    /**
     * array of routes
     * @var array
     */
    private $_routes = array();

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $configReader = ConfigReader::getInstance();
        $routes = $configReader->getConfig("routing");

        $this->addRoutes($routes);
    }

    /**
     * @param array $routes
     */
    private function addRoutes(array $routes)
    {
        foreach($routes as $key => $routeData) {
            $route = new Route($routeData, $key);
            $this->_routes[$route->getUri()] = $route;
        }
    }

    /**
     * @param HttpRequest $request
     * @return mixed
     * @throws InvalidKeyException
     */
    public function route(HttpRequest $request)
    {
        if(isset($this->_routes[$request->getUri()]))
            return $this->_routes[$request->getUri()];
        else throw new InvalidKeyException("Route doesn't exists!");
    }
}