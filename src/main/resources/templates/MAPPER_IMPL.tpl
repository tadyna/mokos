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
    public function __construct(${domain_name}Collection $collection)
    {
        $this->collection = $collection;
    }
    /**
     * Finder method to find entity by given unique key
     * @param mixed $idEntity unique key of entity to be able to find in storage
     * @return ${domain_name} entity
     */
    public function find($idEntity)
    {
        $record = null;//fetch database
        return $this->record2Domain($record);
    }    
    /**
     * Finder method to find all entities
     * @param array conditions for sql where clauzule
     * @return array of ${domain_name} entities
     */
    public function findAll(array $condition=array())
    {
        $records = null;
        return $this->createCollection($records);
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
    /**
     * ${domain_name} entity as associative array
     * @return array
     */
    private function record2Array(array $record)
    {
        ${empty_method}
    }
    /**
     * @return ${domain_name} entity
     */
    private function record2Domain(array $record)
    {
        ${empty_method}
    }    
    /**
     * @return ${domain_name}Dto object
     */
    private function record2Dto(array $record)
    {
        ${empty_method}
    }
    /**
     * Return collection if implements \Countable, \ArrayAccess, \IteratorAggregate interfaces
     * @return ${domain_name}Collection object
     */    
    private function createCollection(array $records)
    {
        $this->collection->clear();
        if ($records) {
            foreach ($records as $record) {
                $this->collection[] = $this->record2Domain($record);
            }
        }
        return $this->collection;
    }
}