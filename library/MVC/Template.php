<?php
/**
 * a template class for Watermail
 */

namespace library\MVC;

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
     * render a page
     */
    public function render()
    {
        var_dump($this->_controller);
        var_dump($this->_action);

        if(file_exists(APP . DS . 'View' . DS . strtolower($this->_controller) . DS . 'header.php'))
            include(APP . DS . 'View' . DS . strtolower($this->_controller) . DS . 'header.php');
        else include(APP . DS . 'View' . DS . 'layout' . DS . 'header.php');

        include(APP . DS . 'View' . DS . strtolower($this->_controller) . DS . $this->_action . '.php');

        if(file_exists(APP . DS . 'View' . DS . strtolower($this->_controller) . DS . 'footer.php'))
            include(APP . DS . 'View' . DS . strtolower($this->_controller) . DS . 'footer.php');
        else include(APP . DS . 'View' . DS . 'layout' . DS . 'footer.php');
    }
}