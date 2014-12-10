<?php
/**
 * A collection iterator class
 */

namespace library\Collection;

use library\Collection\Collection as Collection;

class CollectionIterator implements \Iterator
{
    /**
     * @var int
     */
    private $_currentIndex = 0;

    /**
     * @var array
     */
    private $_keys = array();

    /**
     * @var
     */
    private $_collection;

    /**
     * @param Collection $collection
     */
    public function __construct(Collection $collection)
    {
        $this->_collection = $collection;
        $this->_keys = $this->_collection->getKeys();
    }

    /**
     * rewind to first element
     */
    public function rewind()
    {
        $this->_currentIndex = 0;
    }

    /**
     * get current element
     * @return mixed
     * @throws \library\Exceptions\InvalidKeyException
     */
    public function current()
    {
        return $this->_collection->getItem($this->_keys[$this->_currentIndex]);
    }

    /**
     * get current key
     * @return mixed
     */
    public function key()
    {
        return $this->_keys[$this->_currentIndex];
    }

    /**
     * go to next element
     */
    public function next()
    {
        ++$this->_currentIndex;
    }

    /**
     * check if collection has more items
     * @return bool
     */
    public function hasMore()
    {
        return ($this->_collection->length() >= $this->_currentIndex ? false : true);
    }

    public function valid()
    {

    }
}