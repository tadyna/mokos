<?php
namespace Mokos\Model\Repository;
/**
 * Base interface of repository
 * 
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author tomascejka
 * @category   Provide data
 * @package    Repository
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 */
interface Repository {
	/**
	 * Finder method to find entity by given unique key
	 * @param mixed $idEntity unique key of entity to be able to find in storage
	 * @return object entity
	 */
	public function find($idEntity);
	/**
	 * Finder method to find all entities
	 * @param array conditions for sql where clauzule
	 * @return array of entities
	*/
	public function findAll(array $condition=array());
	/**
	 * Concrete implementation must define a way how transform data and SAVE them
	 * @param integer $idEntity
	 * @return void
	*/
	public function remove($idEntity);
	/**
	 * Concrete implementation must define a way how transform data and persist them
	 * @param object $entity
	 * @return void
	*/
	public function save($entity);
}