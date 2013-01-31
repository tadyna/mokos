<?php
/**
 * @date: ${date}
 * @version: ${version}
 *      
 * ${domain_description}     
 */
class ${domain_name}ServiceImpl
{
    /**
     * @var ${domain_name}Repository repository
     */
    private $${domain_name_lower}Repository;
    /**
     * Inject ${table_name_simple} repository implementation
     * @param ${domain_name}Repository implementation
     */
    protected final function set${domain_name}Repository(${domain_name}Repository $repository) 
    {
        $this->${domain_name_lower}Repository = $repository;
    }
}