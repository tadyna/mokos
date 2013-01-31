<?php
/**
 * @date: ${date}
 * @version: ${version}
 *      
 * ${domain_description}
 * ${mark_annotation}
 */
class ${domain_name}MapperImpl
{
    /**
     * Inject ${table_name_simple} storage implementation
     * @param ${domain_name}Storage implementation
     */
    protected final function set${domain_name}Storage(${domain_name}Storage $storage) 
    {
        $this->storage = $storage;
    }
}