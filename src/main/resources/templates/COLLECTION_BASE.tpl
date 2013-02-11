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
     * @var array collection items
     */
    protected $items = array();
    /**
     * @param $key mixed unique id of object
     * @return mixed object from collection
     */
    public function get($key) 
    {
        return $this->offsetGet($key);
    }
    /**
     * @param $key mixed unique id of object
     * @return bool if $key exists in collection
     */
    public function exists($key) 
    {
        return $this->offsetExists($key);
    }
    /**
     * Clear collection
     * @return void
     */
    public function clear() 
    {
        $this->items = array();
    }
    /**
     * @return array represtation of collection
     */
    public function toArray() 
    {
        return $this->items;
    }
    /**
     * @inheritDoc \Countable
     */
    public function count() 
    {
        return count($this->items);
    }
    /**
     * @inheritDoc \ArrayAccess
     */
    public function offsetGet($key) 
    {
        if (isset($this->items[$key])) {
            return $this->items[$key];
        }
    }
    /**
     * @inheritDoc \ArrayAccess
     */
    public function offsetSet($key, $value) 
    {
        if (!$this->isInstanceOf($value)) {
            throw new \InvalidArgumentException(
                "Could not add the object to the collection.");
        }
        if (!isset($key)) {
            $this->items[] = $value;
        }
        else {
            $this->items[$key] = $value;
        }
    }
    /**
     * @inheritDoc \ArrayAccess
     */
    public function offsetUnset($key) 
    {
        if ($this->isInstanceOf($key)) {
            $this->items = array_filter($this->items,
                function ($v) use ($key) {
                    return $v !== $key;
                });
        }
        else if (isset($this->items[$key])) {
            unset($this->items[$key]);
        }
    }
    /**
     * @inheritDoc \ArrayAccess
     */
    public function offsetExists($key) 
    {
        return ($this->isInstanceOf($key))
            ? array_search($key, $this->items)
            : isset($this->items[$key]);
    }
    /**
     * @inheritDoc \IteratorAggregate
     */
    public function getIterator() 
    {
        return new \ArrayIterator($this->items);
    }
    /**
     * @abstract
     * @return bool subclass must check if item is instanceof concrete domain object
     */
    abstract protected function isInstanceOf($key);
}