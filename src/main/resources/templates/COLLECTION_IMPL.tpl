<?php
/**
 * @date: ${date}
 * @version: ${version}
 * 
 * Implementation interface for ${domain_name} entity
 * ${domain_description}
 */
class ${domain_name}CollectionImpl implements \Countable, \ArrayAccess, \IteratorAggregate
{
    protected $items = array();
    /** 
     * @return domain object
     */
    public function get($key) 
    {
        return $this->offsetGet($key);
    }
    /**
     * @inheritDoc
     */
    public function exists($key) 
    {
        return $this->offsetExists($key);
    }
    /** 
     * Clear inner array and create new array
     * @return void
     */
    public function clear() 
    {
        $this->items = array();
    }
    /**
     * @inheritDoc
     */
    public function toArray() 
    {
        return $this->items;
    }
    /** 
     * @return int count of domain objects in collection
     */
    public function count() 
    {
        return count($this->items);
    }
    /**
     * @inheritDoc
     */
    public function offsetGet($key) 
    {
        if (isset($this->items[$key])) {
            return $this->items[$key];
        }
    }
    /**
     * @inheritDoc
     */
    public function getIterator() 
    {
        return new \ArrayIterator($this->items);
    }
    /**
     * @inheritDoc
     */
    public function add(${domain_name} $entity) 
    {
        $this->offsetSet($entity);
    }
    /**
     * @inheritDoc
     */
    public function remove(${domain_name} $entity) 
    {
        $this->offsetUnset($entity);
    }
    /**
     * @inheritDoc
     */
    public function offsetSet($key, $value) 
    {
        if (!$value instanceof ${domain_name}) {
            throw new \InvalidArgumentException(
                "Could not add the ${domain_name} object to the collection.");
        }
        if (!isset($key)) {
            $this->items[] = $value;
        }
        else {
            $this->items[$key] = $value;
        }
    }
    /**
     * @inheritDoc
     */
    public function offsetUnset($key) 
    {
        if ($key instanceof ${domain_name}) {
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
     * @inheritDoc
     */
    public function offsetExists($key) 
    {
        return ($key instanceof ${domain_name})
            ? array_search($key, $this->items)
            : isset($this->items[$key]);
    }
}