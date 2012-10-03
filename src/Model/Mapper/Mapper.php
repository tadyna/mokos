<?php
namespace Mokos\Model\Mapper;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author tocecz <dev.cejkatomas@gmail.com>
 * @category   Transfer
 * @package    Model
 * @subpackage Mapper
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * class description here ...
 */
interface Mapper {    
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
     * Concrete implementation must define a way how transform data and SAVE them
     * @param object $data
     * @throws MapperException
     * @return void
     */
    public function remove($entity);
    /**
     * Concrete implementation must define a way how transform data and persist them
     * @param object $entity
     * @throws MapperException
     * @return void
     */
    public function save($entity);    
}
