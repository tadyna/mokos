<?php
/**
 * @date: ${date}
 * @version: ${version}
 * 
 * Implementation interface for domain entity
 */
interface ${domain_name}Collection extends \Countable, \ArrayAccess, \IteratorAggregate
{
    /**
     * Add ${domain_name} to collection
     * @return void
     */
    public function add(${domain_name} $entity);
    /**
     * Remove ${domain_name} from collection
     * @return void
     */
    public function remove(${domain_name} $entity);
    /**
     * @return ${domain_name} from collection
     */
    public function get($key);
    /**
     * @return bool is ${domain_name} object exists in collection
     */
    public function exists($key);
    /**
     * clear collection
     */
    public function clear();
    /**
     * @return collection as array
     */
    public function toArray();
    /**
     * @inheritDoc \Countable
     */
    public function count();
    /**
     * @inheritDoc \ArrayAccess
     */
    public function offsetGet($key);
    /**
     * @inheritDoc \ArrayAccess
     */
    public function offsetSet($key, $value);
    /**
     * @inheritDoc \ArrayAccess
     */
    public function offsetUnset($key);
    /**
     * @inheritDoc \ArrayAccess
     */
    public function offsetExists($key);
    /**
     * @inheritDoc \IteratorAggregate
     */
    public function getIterator();    
}