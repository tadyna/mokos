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
         return $this->${domain_name_lower}Mapper->find($idEntity);
    }
    /**
     * @inheritDoc
     */
    public function findAll(array $condition=array())
    {
         return $this->${domain_name_lower}Mapper->findAll($condition);
    }
    /**
     * @inheritDoc
     */
    public function remove($idEntity)
    {
        return $this->${domain_name_lower}Mapper->remove($idEntity); 
    }
    /**
     * @inheritDoc
     */
    public function removeAll(array $condition=array())
    {
         return $this->${domain_name_lower}Mapper->removeAll($condition);
    }
    /**
     * @inheritDoc
     */
    public function save(${domain_name} $entity)
    {
         return $this->${domain_name_lower}Mapper->save($entity);
    }   
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