<?php
/**
 * a template class for Watermail
 */

namespace library\MVC;

use library\Exceptions\InvalidKeyException as InvalidKeyException;

class Template
{
    /**
     * @var array
     */
    protected $_variables = array();
    /**
     * @var
     */
    protected $_controller;
    /**
     * @var
     */
    protected $_action;

    /**
     * @param $controller
     * @param $action
     */
    public function __construct($controller, $action)
    {
        $this->_controller = $controller;
        $this->_action = $action;
    }

    /**
     * @param $name
     * @param $value
     */
    public function set($name, $value)
    {
        $this->_variables[$name] = $value;
    }

    /**
     * @param $key
     * @return mixed
     * @throws InvalidKeyException
     */
    public function __get($key)
    {
        if(isset($this->_variables[$key]))
            return $this->_variables[$key];
        else
            throw new InvalidKeyException("Variable with key $key doesn't exists!");
    }

    /**
     * render a page
     */
    public function render()
    {
        if(file_exists(APP . DS . 'View' . DS . 'layout' . DS . 'navigation.php'))
            $navigation = APP . DS . 'View' . DS . 'layout' . DS . 'navigation.php';
        if(file_exists(APP . DS . 'View' . DS . strtolower($this->_controller) . DS . $this->_action . '.php'))
            $content = APP . DS . 'View' . DS . strtolower($this->_controller) . DS . $this->_action . '.php';
        if(file_exists(APP . DS . 'View' . DS . 'layout' . DS . 'footer.php'))
            $footer = APP . DS . 'View' . DS . 'layout' . DS . 'footer.php';

        include(APP . DS . 'View' . DS . 'index.php');
    }
}