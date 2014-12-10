<?php
/**
 * A config reader class, using to reading the config files
 */

namespace library;


class ConfigReader
{

    private static $_instance = null;
    /**
     * path of current using config file
     * @var string
     */
    private $_filePath = ROOT;

    /**
     * name of current using config file
     * @var string
     */
    private $_fileName = '';

    /**
     * array of loaded config files
     * @var array
     */
    private $_configs = array();

    /**
     *
     */
    private function __construct()
    {

    }

    /**
     * get an instance of ConfigReader object
     * @return ConfigReader|null
     */
    public static function getInstance()
    {
        if(self::$_instance === null) self::$_instance = new ConfigReader();
        return self::$_instance;
    }

    /**
     * get a config from file
     * @param $fileName
     * @return mixed
     * @throws \Exception
     */
    public function getConfig($fileName)
    {
        $filePath = ROOT . DS . 'config' . DS . $fileName . '.php';
        if(is_file($filePath) && is_readable($filePath)) {
            $this->_filePath = $filePath;
            $this->_fileName = $fileName;

            $this->_configs[$this->_fileName] = require($filePath);
            return $this->_configs[$this->_fileName];
        } else
            throw new \Exception("This config file ($filePath) doesn't exists!");
    }
}