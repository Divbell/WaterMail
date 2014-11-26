<?php
/**
 * A base Model class for Watermail
 */

class Model extends DBHandler
{
    /**
     * @var
     */
    protected $_model;

    /**
     *@create a database connection
     */
    public function __construct()
    {
        $this->connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $this->_model = get_class($this);
        $this->_table = strtolower($this->_model) . "s";
    }

    public function __destruct()
    {

    }
}