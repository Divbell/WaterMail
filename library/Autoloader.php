<?php
/**
 * An autoloader class
 */

namespace library;

use library\Routing;
use library\Exceptions;

class Autoloader
{
    /**
     * @var
     */
    private static $_instance;

    /**
     * @var array
     */
    private $_loaded = array();

    /**
     *
     */
    private function __construct()
    {
        $this->registerAutoloader();
    }

    /**
     * Get instance of autoloader
     * @return Autoloader
     */
    public static function getInstance()
    {
        if(self::$_instance === null) self::$_instance = new Autoloader();
        return self::$_instance;
    }

    /**
     *
     */
    private function registerAutoloader()
    {
        spl_autoload_register(array($this, 'autoload'));
    }

    /**
     * Autoload method
     *
     * @param $className
     * @throws \Exception
     */
    public function autoload($className)
    {
        echo $className . '<br />';
        $fileName = ROOT . DS . str_replace('\\', DS, $className) . '.php';

        if(!isset($this->_loaded[$className])) {
            if(file_exists($fileName))
                require_once($fileName);
            else throw new \Exception("This controller or model doesn't exists!");

            $this->_loaded[$className] = true;
        }
    }

    /**
     * Get loaded classes
     * @return array
     */
    public function getLoaded()
    {
        return $this->_loaded;
    }
}