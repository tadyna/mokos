<?php
/**
 * @date: ${date}
 * @version: ${version}
 * 
 * ${mark_annotation}
 */
class ${domain_name}RepositoryImpl implements ${domain_name}Repository
{
    /**
     * @inheritDoc
     */
    public function find($idEntity)
    {
         $result = $this->${domain_name_lower}Mapper->find($idEntity);
         $domain = new ${domain_name}();
         Array2Domain::convert${domain_name}($result, $domain);
         return $domain;
    }
    /**
     * @inheritDoc
     */
    public function findAll(array $condition=array())
    {
         $result = $this->${domain_name_lower}Mapper->findAll($condition);
         $retval = array();
         foreach ($result as $row) {
            $domain = new ${domain_name}();
            Array2Domain::convert${domain_name}($result, $domain);
            $retval['${domain_primary_key}'] = $domain;
         }
    }
    /**
     * @inheritDoc
     */
    public function remove($idEntity)
    {
        $this->${domain_name_lower}Mapper->remove($idEntity); 
    }
    /**
     * @inheritDoc
     */
    public function removeAll(array $condition=array())
    {
         $this->${domain_name_lower}Mapper->removeAll($condition);
    }
    /**
     * @inheritDoc
     */
    public function save(${domain_name} $entity)
    {
         return $this->${domain_name_lower}Mapper->save($entity);
    }
    ${relations_methods}    /**
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
    /**
     * @var ${domain_name}Mapper mapper
     */
    private $${domain_name_lower}Mapper;
    /**
     * @var ${domain_name}Collection $collection
     */
    private $${domain_name_lower}Collection;    
    /**
     * Inject ${table_name_simple} mapper implementation
     * @param ${domain_name}Mapper implementation
     */
    protected final function set${domain_name}Mapper(${domain_name}Mapper $mapper) 
    {
        $this->${domain_name_lower}Mapper = $mapper;
    }  
    /**
     * Inject ${table_name_simple} collection implementation
     * @param ${domain_name}Collection implementation
     */
    protected final function set${domain_name}Collection(${domain_name}Collection $collection) 
    {
        $this->${domain_name_lower}Collection = $collection;
    }     
}