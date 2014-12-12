<?php
/**
 * Front Controller
 */

namespace library;

use library\Interfaces\FrontControllerInterface as FrontControllerInterface;
use library\Request\HttpRequest;
use library\Routing\Router;

Class FrontController implements FrontControllerInterface
{
    /**
     * const, that contains default controller's and action's name
     */
    const DEFAULT_CONTROLLER = 'index';
    const DEFAULT_ACTION = 'index';
    const CONTROLLER_DIRECTORY = "app\\Controller\\";

    /**
     * @var
     */
    private $_controller;

    /**
     * @var
     */
    private $_action;

    /**
     * @var array
     */
    private $_params = array();

    /**
     * @var
     */
    private $_router;

    /**
     *
     */
    public function __construct()
    {
        $this->_router = new Router();

        $route = $this->_router->route(new HttpRequest());

        $controllerName = $route->getControllerName();
        $actionName = $route->getActionName();

        $this->_params["model"] = $controllerName;
        $this->_params["controller"] = $controllerName;
        $this->_params["action"] = $actionName;

        $this->setController($controllerName);
        $this->setAction($actionName);
    }

    /**
     * @param $controller
     */
    public function setController($controller)
    {
        $controller = self::CONTROLLER_DIRECTORY . ucfirst(strtolower($controller)) . 'Controller';
        if(!class_exists($controller))
            throw new \InvalidArgumentException("Controller $controller doesn't exists!");
        $this->_controller = $controller;
    }

    /**
     * @param $action
     */
    public function setAction($action)
    {
        $action .= 'Action';
        $reflector = new \ReflectionClass($this->_controller);
        if(!$reflector->hasMethod($action))
            throw new \InvalidArgumentException("Action $action of current controller doesn't exists!");
        $this->_action = $action;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params)
    {
        $this->_params = $params;
    }

    /**
     * runs set action
     */
    public function run()
    {

        $controller = new $this->_controller($this->_params);
        $action = $this->_action;

        $controller->$action();
    }

}