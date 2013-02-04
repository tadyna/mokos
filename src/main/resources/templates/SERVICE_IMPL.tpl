<?php
/**
 * @date: ${date}
 * @version: ${version}
 *   
 * Base implemenation service of ${domain_description} entity
 * ${mark_annotation}
 */
class ${domain_name}ServiceImpl implements ${domain_name}Service
{
    /**
     * @inheritDoc
     */
    public function create${domain_name}(array $data)
    {
        //TODO conversion/translation dto object to domain
        $domain = new ${domain_name}();
        $this->${domain_name_lower}Repository->create($domain);
    }
    /**
     * @inheritDoc
     */
    public function update${domain_name}(array $data)
    {
        //TODO conversion/translation dto object to domain
        $domain = null;
        $this->${domain_name_lower}Repository->update($domain);
    }
    /**
     * @inheritDoc
     */
    public function delete${domain_name}($idEntity)
    {
        $this->${domain_name_lower}Repository->remove($idEntity);
    }
    /**
     * @inheritDoc
     */
    public function deleteAll${domain_name}s()
    {
        $this->${domain_name_lower}Repository->removeAll();
    }
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