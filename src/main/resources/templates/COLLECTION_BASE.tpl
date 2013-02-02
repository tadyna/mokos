<?php
/**
 * @date: ${date}
 * @version: ${version}
 * 
 * Implementation interface for domain entity
 */
abstract class CollectionBase implements \Countable, \ArrayAccess, \IteratorAggregate
{
    /**
     * @inheritDoc
     */
    public function get($key) {
        return $this->offsetGet($key);
    }
    /**
     * @inheritDoc
     */
    public function exists($key) {
        return $this->offsetExists($key);
    }
    /**
     * @inheritDoc
     */
    public function clear() {
        $this->items = array();
    }
    /**
     * @inheritDoc
     */
    public function toArray() {
        return $this->items;
    }
    /**
     * @inheritDoc
     */
    public function count() {
        return count($this->items);
    }
    /**
     * @inheritDoc
     */
    public function offsetGet($key) {
        if (isset($this->items[$key])) {
            return $this->items[$key];
        }
    }
    /**
     * @inheritDoc
     */
    public function getIterator() {
        return new \ArrayIterator($this->items);
    }
}