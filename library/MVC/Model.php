<?php
/**
 * A base Model class for Watermail
 */

namespace library\MVC;

class Model
{
    /**
     * @var
     */
    protected $_model;

    /**
     *create a database connection
     */
    public function __construct()
    {

    }

    public function checkModel()
    {
        echo "model works";
    }
}