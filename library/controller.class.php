<?php
/**
 * A base Controller class for Watermail
 */

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
     * @param $model
     * @param $controller
     * @param $action
     */
    public function __construct($model, $controller, $action)
    {
        $this->_model = $model;
        $this->_controller = $controller;
        $this->_action = $action;

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
     * render the page after destroying the object
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