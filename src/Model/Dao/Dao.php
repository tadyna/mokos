<?php
namespace Mokos\Model\Dao;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @author derhaa <dev.cejkatomas@gmail.com>
 * @category   Generator
 * @package    Expression package is undefined on line 15, column 18 in Templates/Scripting/PHPClass_1.php.
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * Basic interface for Data Access Object pattern
 */
interface Dao 
{
    /**
     * Create or update entity in storage
     * @param mixed $entity
     */
    public function save($entity);   
    /**
     * Delete entity from storage
     * @param mixed $entity
     */
    public function delete($entity); 
    /**
     * Get entity by unique identificator
     * @param integer $idEntity
     */
    public function findById($idEntity);
    /**
     * Get all entities which matches filter criteria given by parameter.
     * If parameter is empty it means get all entities.
     * @param array $condition
     */
    public function findAll(array $condition = array());
}