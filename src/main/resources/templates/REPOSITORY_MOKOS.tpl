<?php
use Mokos\Model\Repository\Repository;
/**
 * @date: ${date}
 * @version: ${version}
 *      
 * ${domain_description} 
 * ${mark_annotation}
 */
class ${domain_name}Repository extends RepositoryDomain
{
    /**
     * @var ${domain_name}Mapper mapper
     */
    private $${domain_name_lower}Mapper;
    /**
     * Inject ${table_name_simple} mapper implementation
     * @param ${domain_name}Mapper implementation
     */
    public function __construct(${domain_name}Mapper $mapper)
    {
        $this->${domain_name_lower}Mapper = $mapper;
    }
}