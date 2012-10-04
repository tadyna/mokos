<?php
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
     * @return string represetantion of entity
     * @throw EntityException if serialization fails
     */
    protected final function writedObject() {
        return ${serialization};
    }
    /**
     * It allows deserializovat entity from various sources
     * @param mixed $serialized 
     * @throw EntityException if deserialization fails
     */
    protected final function readObject($serialized) {
        if(is_array($serialized)) {
            ${unserialization_from_array}
        } else if (is_object($serialized)) {
            ${unserialization_from_object}
        } else {
            throw new Exception('${domain_name} object cannot be deserialized', null, null);
        }
    }
}