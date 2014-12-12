<?php
/**
 * A base Controller class for Watermail
 */

namespace library\MVC;

class Controller
{
    /**
     * used model
     * @var
     */
    protected $_model;
    /**
     * current controller
     * @var
     */
    protected $_controller;
    /**
     * chosen action
     * @var
     */
    protected $_action;
    /**
     * template to render
     * @var
     */
    protected $_template;

    /**
     * @param array $controllerData
     */
    public function __construct($controllerData = array())
    {
        $this->_model = $controllerData["model"];
        $this->_controller = $controllerData["controller"];
        $this->_action = $controllerData["action"];

        $this->_template = new Template($this->_controller, $this->_action);
    }

    /**
     * @param $name
     * @param $value
     */
    public function set($name, $value)
    {
        $this->_template->set($name, $value);
    }

    /**
     * render the page
     */

    public function render()
    {
        $this->_template->render();
    }

    /**
     * redirect to passed url
     * @param $url
     */
    public function redirect($url)
    {
        header("Location: " . $url);
        exit;
    }
}