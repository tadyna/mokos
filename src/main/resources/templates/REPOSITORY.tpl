<?php
/**
 * @date: ${date}
 * @version: ${version}
 *      
 * ${domain_description}
 * ${mark_annotation}
 */
class ${domain_name}Repository
{
    /**
     * @var ${domain_name}Mapper mapper
     */
    private $${domain_name_lower}Mapper;
    /**
     * Inject ${table_name_simple} mapper implementation
     * @param ${domain_name}Mapper implementation
     */
    protected final function set${domain_name}Mapper(${domain_name}Mapper $mapper) 
    {
        $this->${domain_name_lower}Mapper = $mapper;
    }
}