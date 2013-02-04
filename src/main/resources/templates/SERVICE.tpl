<?php
/**
 * @date: ${date}
 * @version: ${version}
 *      
 * Service for ${domain_description} entity
 */
interface ${domain_name}Service
{
    /**
     * Create ${domain_name} object
     * @param array transfer object
     * @return array object
     */
    public function create${domain_name}(array $data);
    /**
     * Update ${domain_name} object
     * @param array transfer object
     * @return void
     */
    public function update${domain_name}(array $data);
    /**
     * Delete ${domain_name} object
     * @param int unique key of domain entity
     * @return void
     */
    public function delete${domain_name}($idEntity);
    /**
     * Delete all existing ${domain_name} entities
     * @return void
     */
    public function deleteAll${domain_name}();  
}