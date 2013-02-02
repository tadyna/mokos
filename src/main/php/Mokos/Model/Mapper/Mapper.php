<?php
namespace Mokos\Model\Mapper;
use Mokos\Model\Domain\Entity;
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
     * Finder method to find entity by given unique key
     * @param mixed $idEntity unique key of entity to be able to find in storage
     * @return object entity
     */
    public function find($idEntity);
    /**
     * Finder method to find all entities
     * @param array where condition
     * @return object entity
     */
    public function findAll(array $condition = array());
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
     * @param array where condition
     * @throws MapperException
     * @return void
     */
    public function removeAll(array $conditions = array());    
    /**
     * Concrete implementation must define a way how transform data and persist them
     * @param Mokos\Model\Domain\Entity $entity
     * @throws MapperException
     * @return void
     */
    public function save(Entity $entity);
    /**
     * @return array representation of domain object
     */
    public function record2Array($record);    
    /**
     * @return Mokos\Model\Domain\Entity entity
     */
    public function record2Domain($record);
    /**
     * @return Mokos\Model\Dto\Dto object
     */
    public function record2Dto($record);    
}