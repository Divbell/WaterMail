<?php
/**
 * Front Controller
 */

namespace library;

use library\Interfaces\FrontControllerInterface as FrontControllerInterface;
use library\Request\HttpRequest;

Class FrontController implements FrontControllerInterface
{
    /**
     * const, that contains default controller's and action's name
     */
    const DEFAULT_CONTROLLER = 'IndexController';
    const DEFAULT_ACTION = 'indexAction';

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
     * @var string
     */
    private $_basePath = ROOT;

    /**
     * @param HttpRequest $request
     */
    public function __construct(HttpRequest $request)
    {
        $this->parseUri($request);
    }


    private function parseUri(HttpRequest $request)
    {
        $path = trim(parse_url($request->getUri(), PHP_URL_PATH), '/');

        var_dump($path);
        $pathData = explode("/", $path, 3);
        var_dump($pathData);
        $controller = $pathData[0];
        $action = $pathData[1];
        $params = explode("/", $pathData[2]);

        if(isset($controller))
            $this->setController($controller);
        else $this->_controller = self::DEFAULT_CONTROLLER;
        if(isset($action))
            $this->setAction($action);
        else $this->_action = self::DEFAULT_ACTION;
        if(isset($params))
            $this->setParams($params);
    }

    /**
     * @param $controller
     */
    public function setController($controller)
    {
        $controller = 'app\\Controller\\' . ucfirst(strtolower($controller)) . 'Controller';
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
        call_user_func_array(array(new $this->_controller, $this->_action), $this->_params);
    }

}