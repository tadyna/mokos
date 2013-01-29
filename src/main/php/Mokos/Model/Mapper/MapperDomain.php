<?php
namespace Mokos\Model\Mapper;
use Mokos\Model\Storage\Storage;
use Mokos\Model\Domain\Entity;
use Mokos\Model\Mapper\Mapper;
/**
 * Domain mapper implementation. It must be extended for specific domain object.
 * 
 * LICENCE
 *   The MIT License
 *   
 * @abstract
 * @author tomascejka
 * @category   Mapping data domain object 
 * @package    Mapper
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 */
abstract class MapperDomain implements Mapper {
	/**
	 * Implementation of storage saves given entity
	 * @param $entity \Mokos\Model\Domain\Entity
	 */
	public function save(Entity $entity) {
		if($entity->getId() == null) {
			$this->storage->insert($entity);
		} else {
			$this->storage->update($entity);	
		}
	}
	/**
	 * Implementation of storage remove given entity
	 * @see \Mokos\Model\Mapper\Mapper::remove()
	 */
	public function remove($idEntity) {
		$this->storage->delete($idEntity);
	}
	/**
	 * Implementation of storage execute given sql query
	 * @see \Mokos\Model\Mapper\Mapper::query()
	 */
	public function query($query) {
		$this->storage->query($query);
	}
	/**
	 * Implementation of storage fetch all entities
	 * @see \Mokos\Model\Mapper\Mapper::findAll()
	 * @return array of \Mokos\Model\Domain\Entity objects
	 */
	public function findAll(array $condition = array()) {
		$records = $this->storage->findAll($condition);
		if ($records == null) return array();
		$entities = array();
		for ($i = 0; $i < count($records); $i++) {
			$entities[] = $this->record2Domain($records[$i]);
		}
		return $entities;
	}
	/**
	 * Implementation of storage fetch entity by given unique identificator
	 * @see \Mokos\Model\Mapper\Mapper::find()
	 * @return \Mokos\Model\Domain\Entity
	 */
	public function find($idEntity) {
		$record = $this->storage->find($idEntity);
		if($record == null) return null;
		return $this->record2Domain($record);
	}
	/**
	 * Concrete domain mapper must defined how to map table row result to domain object
	 * @param mixed $record table row from database
	 * @throws \Exception if method is not overrided by implementation
	 * @return \Mokos\Model\Domain\Entity
	 */
	protected function record2Domain($record) {
		throw new \Exception("Must be overrided by concrete mapper implementation");
	}
	/*
	 * -- ALPHA FUNCIONALITY -- 
	 * Feature which is not implemented!! There is no support for this funcionality
	 * 
	 * Concrete domain mapper must defined how to map table row result to dto object
	 * @param mixed $record table row from database
	 * @throws \Exception if method is not overrided by implementation
	 * @return \Mokos\Model\Dto\Dto
	 */
	protected function record2Dto($record) {
		//throw new \Exception("Must be overrided by concrete mapper implementation");
		throw new \Exception("Not implemented right now");
	}
	/**
	 * Storage implemenation
	 * @var \Mokos\Model\Storage\Storage
	 */
	private $storage;
	/**
	 * Injection of storage implementation
	 * @param \Mokos\Model\Storage\Storage $storage
	 */
	public final function setStorage(Storage $storage){
		$this->storage = $storage;
	}	
}