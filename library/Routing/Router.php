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
     * collection of routes
     * @var RouteCollection
     */
    private $_routes;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->_routes = new RouteCollection();
        $this->_routes->setLoadFunction('loadRoutes', $this);
    }

    /**
     * @param HttpRequest $request
     * @return mixed
     * @throws InvalidKeyException
     */
    public function route(HttpRequest $request)
    {
        if($this->_routes->exists($request->getUri()))
            return $this->_routes->getItem($request->getUri());
        else throw new InvalidKeyException("Route doesn't exists!");
    }

    /**
     * @param RouteCollection $collection
     * @throws \Exception
     */
    public function loadRoutes(RouteCollection $collection)
    {
        $configReader = ConfigReader::getInstance();
        $routes = $configReader->getConfig("routing");

        foreach($routes as $key => $routeData) {
            $route = new Route($routeData, $key);
            $collection->addItem($route, $route->getUri());
        }
    }
}