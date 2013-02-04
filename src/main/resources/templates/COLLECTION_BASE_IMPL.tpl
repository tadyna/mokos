<?php
/**
 * @date: ${date}
 * @version: ${version}
 * 
 * Implementation interface for ${domain_name} entity
 * ${domain_description}
 */
class ${domain_name}CollectionImpl extends CollectionBase implements ${domain_name}Collection
{
    /**
     * @inheritDoc
     * @param ${domain_name} $entity
     */
    public function add(${domain_name} $entity) 
    {
        $this->offsetSet($entity->${domain_get_primary_method}, $entity);
    }
    /**
     * @inheritDoc
     * @param ${domain_name} $entity
     */
    public function remove(${domain_name} $entity) 
    {
        $this->offsetUnset($entity->${domain_get_primary_method} , $entity);
    }
    /**
     * @inheritDoc
     */
    protected function isInstanceOf($key)
    {
        return $key instanceOf ${domain_name};
    }
}