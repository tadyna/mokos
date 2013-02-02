<?php
/**
 * @date: ${date}
 * @version: ${version}
 * 
 * Collection interface for ${domain_name} entity
 */
interface ${domain_name}Collection extends \Countable, \ArrayAccess, \IteratorAggregate 
{
    /**
     * @inheritDoc
     */
    public function add(${domain_name} $entity);
    /**
     * @inheritDoc
     */
    public function remove(${domain_name} $entity);
    /**
     * @inheritDoc
     */    
    public function get($key);
    /**
     * @inheritDoc
     */    
    public function exists($key);
    /**
     * @inheritDoc
     */    
    public function clear();
    /**
     * @inheritDoc
     */    
    public function toArray();   
}