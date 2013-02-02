<?php
/**
 * @date: ${date}
 * @version: ${version}
 * 
 * ${mark_annotation}
 */
interface ${domain_name}Repository 
{
    /**
    * Finder method to find entity by given unique key
    * @param mixed $idEntity unique key of entity to be able to find in storage
    * @return ${domain_name} entity
    */
   public function find($idEntity);
   /**
    * Finder method to find all entities
    * @param array conditions for sql where clauzule
    * @return array of ${domain_name} entities
   */
   public function findAll(array $condition=array());
   /**
    * Concrete implementation must define a way how remove entity
    * @param integer $idEntity
    * @return void
   */
   public function remove($idEntity);
   /**
    * Concrete implementation must define a way how remove entities
    * @param array conditions for sql where clauzule
    * @return void
   */
   public function removeAll(array $condition=array());        
   /**
    * Concrete implementation must define a way how transform data and persist them
    * @param ${domain_name} $entity
    * @return void
   */
   public function save(${domain_name} $entity);
}