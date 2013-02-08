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
     * Add array of ${domain_name} to collection
     * @return void
     */
    public function addAll(array $${domain_name_lower}s)
    {
        //TODO ....
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
     * Remove array of ${domain_name} from collection
     * @return void
     */
    public function removeAll(array $${domain_name_lower}s = null)
    {
        //TODO ....
    }
    /**
     * @inheritDoc
     */
    protected function isInstanceOf($key)
    {
        return $key instanceOf ${domain_name};
    }
}