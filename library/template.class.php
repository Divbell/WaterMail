<?php
/**
 * a template class for Watermail
 */

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
        extract($this->_variables);

        if(file_exists(APP . DS . 'view' . DS , $this->_controller . DS . 'header.php'))
            include(APP . DS . 'view' . DS . $this->_controller . DS . 'header.php');
        else include(APP . DS . 'view' . DS . 'layout' . DS . 'header.php');

        include(APP . DS . 'view' . DS . $this->_controller . DS . $this->_action . '.php');

        if(file_exists(APP . DS . 'view' . DS . $this->_controller . DS . 'footer.php'))
            include(APP . DS . 'view' . DS . $this->_controller . DS . 'footer.php');
        else include(APP . DS . 'view' . DS . 'layout' . DS . 'footer.php');
    }
}