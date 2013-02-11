<?php
/**
 * @date: ${date}
 * @version: ${version}
 * 
 * Collection interface for ${domain_name} entity
 */
interface ${domain_name}Collection
{
    /**
     * Add ${domain_name} to collection
     * @return void
     */
    public function add(${domain_name} $entity);
    /**
     * Add array of ${domain_name} to collection
     * @return void
     */
    public function addAll(array $${domain_name_lower}s);  
    /**
     * Remove ${domain_name} from collection
     * @return void
     */
    public function remove(${domain_name} $entity); 
    /**
     * Remove array of ${domain_name} from collection
     * @return void
     */
    public function removeAll(array $${domain_name_lower}s = null);   
    ${relations_methods}
}