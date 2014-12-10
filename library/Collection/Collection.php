<?php
/**
 * A collection pattern class
 */

namespace library\Collection;

use library\Exceptions\KeyInUseException as KeyInUseException;
use library\Exceptions\InvalidKeyException as InvalidKeyException;
use library\Collection\CollectionIterator as CollectionIterator;

class Collection implements \IteratorAggregate
{
    /**
     * @var array
     */
    private $_items = array();

    /**
     * @var bool
     */
    private $_isLoaded = false;


    /**
     * @var
     */
    private $_onLoad;

    /**
     * @param $item
     * @param null $key
     * @throws KeyInUseException
     */
    public function addItem($item, $key = null)
    {
        $this->_isLoaded();

        if($key) {
            if(isset($this->_items[$key]))
                throw new KeyInUseException("Key $key is already taken!");
            else
                $this->_items[$key] = $item;
        } else
            $this->_items[] = $item;
    }

    /**
     * @param $key
     * @throws InvalidKeyException
     */
    public function removeItem($key)
    {
        $this->_isLoaded();

        if(!isset($this->_items[$key]))
            throw new InvalidKeyException("Key $key doesn't exist in this collection!");
        else
            unset($this->_items[$key]);
    }

    /**
     * @param $key
     * @return mixed
     * @throws InvalidKeyException
     */
    public function getItem($key)
    {
        $this->_isLoaded();

        if(!isset($this->_items[$key]))
            throw new InvalidKeyException("Key $key doesn't exist in this collection!");
        else
            return $this->_items[$key];
    }

    /**
     * @return array
     */
    public function getItems()
    {
        $this->_isLoaded();

        return $this->_items;
    }

    /**
     * @return array
     */
    public function getKeys()
    {
        $this->_isLoaded();

        return array_keys($this->_items);
    }

    /**
     * @return int
     */
    public function length()
    {
        $this->_isLoaded();

        return sizeof($this->_items);
    }

    /**
     * @param $key
     * @return bool
     */
    public function exists($key)
    {
        $this->_isLoaded();

        return (isset($this->_items[$key]));
    }

    /**
     * set load function for collection
     *
     * @param $functionName
     * @param null $ObjOrClass
     * @throws \Exception
     */
    public function setLoadFunction($functionName, $ObjOrClass = null)
    {
        if($ObjOrClass != null) $callable = array($ObjOrClass, $functionName);
        else $callable = $functionName;

        if(!is_callable($callable, false, $callableName))
            throw new \Exception("Function $callableName cannot be called!");
        $this->_onLoad = $callable;
    }

    /**
     * check if data is loaded - if not, load
     */
    private function _isLoaded()
    {
        if($this->_onLoad && !$this->_isLoaded) {
            $this->_isLoaded = true;
            call_user_func($this->_onLoad, $this);
        }
    }

    /**
     * get collection iterator for collection
     * @return CollectionIterator
     */
    public function getIterator()
    {
        $this->_isLoaded();

        return new CollectionIterator(clone $this);
    }
}