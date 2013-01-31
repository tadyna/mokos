<?php
use Mokos\Model\Mapper\Mapper;
/**
 * @date: ${date}
 * @version: ${version}
 *      
 * ${domain_description}
 * ${mark_annotation}
 */
class ${domain_name}MapperImpl implements Mapper
{
    /**
     * @var ${domain_name}Storage mapper
     */
    private $${domain_name_lower}Storage;
    /**
     * Inject ${table_name_simple} storage implementation
     * @param ${domain_name}Storage implementation
     */
    protected final function set${domain_name}Storage(${domain_name}Storage $storage) 
    {
        $this->${domain_name_lower}Storage = $storage;
    }
}