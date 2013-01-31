<?php
use Mokos\Model\Domain\Entity;
/**
 *
 * @date: ${date}
 * @version: ${version}
 *      
 * ${domain_description}     
 */
class ${domain_name} extends Entity
{
    ${clazz_fields}
    ${clazz_get_set_methods}
    /**
     * @return array represetantion of entity
     * @throw EntityException if serialization fails
     */
    protected final function serialize() 
    {
        //do something
    }
    /**
     * It allows deserializovat entity from various sources
     * @param mixed $serialized 
     * @throw EntityException if deserialization fails
     */
    protected final function unserialize($serialized) 
    {
        if(is_array($serialized)) {
            // do something
        } else if (is_object($serialized)) {
            //do something
        } else {
            throw new Exception('${domain_name} object cannot be deserialized', null, null);
        }
    }
}