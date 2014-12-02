<?php
/**
 * A router class
 */

namespace library;

use library\Routing\Route as Route;

Class Router
{
    /**
     * @var
     */
    private $_url;

    /**
     * @var
     */
    private $_currentController;

    /**
     * @var
     */
    private $_currentAction;

    public function __construct($url)
    {
        $this->_url = $url;
    }

    public function getRoute()
    {
        $urlParts = explode('/', $this->_url);

        $this->_currentController = ucfirst($urlParts[0]);
        $this->_currentAction = $urlParts[1];
        var_dump($urlParts);
    }

    public function dispatch()
    {
        $controllerName = 'app\\Controller\\' . $this->_currentController . 'Controller';
        $actionName = $this->_currentAction . 'Action';

        $controller = new $controllerName($this->_currentAction, $this->_currentController, $this->_currentAction);
        $controller->$actionName();
    }
}