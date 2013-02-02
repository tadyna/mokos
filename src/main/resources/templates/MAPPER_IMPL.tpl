<?php
/**
 * @date: ${date}
 * @version: ${version}
 *      
 * ${domain_description}
 * ${mark_annotation}
 */
class ${domain_name}MapperImpl implements ${domain_name}Mapper 
{
    /**
     * Finder method to find entity by given unique key
     * @param mixed $idEntity unique key of entity to be able to find in storage
     * @return ${domain_name} entity
     */
    public function find($idEntity)
    {
        ${empty_method}
    }    
    /**
     * Finder method to find all entities
     * @param array conditions for sql where clauzule
     * @return array of ${domain_name} entities
     */
    public function findAll(array $condition=array())
    {
        ${empty_method}
    }    
    /**
     * Concrete implementation can use this for writing and executing specific sql queries
     * @param string $query sql query
     * @throws MapperException
     * @return object|array 
     */    
    public function query($query)
    {
        ${empty_method}
    }    
    /**
     * Concrete implementation must define a way how delete entity
     * @param integer $idEntity unique id of entity
     * @throws MapperException
     * @return void
     */
    public function remove($idEntity)
    {
        ${empty_method}
    }    
    /**
     * Concrete implementation must define a way how delete entities
     * @param array conditions for sql where clauzule
     * @throws MapperException
     * @return void
     */
    public function removeAll(array $condition=array())
    {
        ${empty_method}
    }    
    /**
     * Concrete implementation must define a way how transform data and persist them
     * @param object $entity
     * @throws MapperException
     * @return void
     */
    public function save(${domain_name} $entity)
    {
        ${empty_method}
    }    
}