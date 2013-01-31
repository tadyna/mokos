<?php
namespace Mokos\Model\Mapper;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author tomascejka
 * @category   Mapping data
 * @package    Mapper
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * Base interface of mapper
 */
interface Mapper 
{    
    /**
     * Each mapper knows how to map storage entity as array
     * @param integer $idEntity
     * @return array representation of entity from storage
     */
    public function entity2Array($idEntity); 
    /**
     * Finder method to find entity by given unique key
     * @param mixed $idEntity unique key of entity to be able to find in storage
     * @return object entity
     */
    public function find($idEntity);
    /**
     * Finder method to find all entities
     * @return object entity
     */
    public function findAll();
    /**
     * Concrete implementation can use this for writing and executing specific sql queries
     * @param string $query sql query
     * @throws MapperException
     * @return object|array 
     */    
    public function query($query);
    /**
     * Concrete implementation must define a way how delete entity
     * @param integer $idEntity unique id of entity
     * @throws MapperException
     * @return void
     */
    public function remove($idEntity);
    /**
     * Concrete implementation must define a way how delete entities
     * @param integer $idEntity unique id of entity
     * @throws MapperException
     * @return void
     */
    public function removeAll();    
    /**
     * Concrete implementation must define a way how transform data and persist them
     * @param object $entity
     * @throws MapperException
     * @return void
     */
    public function save($entity);    
}