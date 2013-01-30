<?php
namespace Mokos\Model\Repository;
use Mokos\Model\Repository\Repository;
use Mokos\Model\Mapper\MapperDomain;
/**
 * Base interface of domain repository
 *
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author tomascejka
 * @category   Provide data of domain object
 * @package    Repository
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 */
abstract class RepositoryDomain implements Repository 
{
	/*
	 * (non-PHPdoc)
	 * @see \Mokos\Model\Repository\Repository::save()
	 */
	public function save($entity) 
        {
		$this->mapper->save($entity); 
	}
	/*
	 * (non-PHPdoc)
	 * @see \Mokos\Model\Repository\Repository::remove()
	 */
	public function remove($idEntity) 
        {
		$this->mapper->remove($idEntity);
	}
	/*
	 * (non-PHPdoc)
	 * @see \Mokos\Model\Repository\Repository::findAll()
	 */
	public function findAll(array $condition = array()) 
        {
		return $this->mapper->findAll($condition); 
	}
	/*
	 * (non-PHPdoc)
	 * @see \Mokos\Model\Repository\Repository::find()
	 */
	public function find( $idEntity) 
        {
		return $this->mapper->find($idEntity);
	}
	/**
	 * @var \Mokos\Model\Mapper\MapperDomain
	 */
	private $mapper;
	/**
	 * Injection of mapper implementation
	 * @param \Mokos\Model\Mapper\MapperDomain $mapper
	 */
	public final function __construct(MapperDomain $mapper)
        {
		$this->mapper = $mapper;
	}
}