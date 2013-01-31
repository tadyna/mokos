<?php
namespace Mokos\Model\Storage\PDO;
use Mokos\Model\Storage\Storage;
/**
 * Basic interface for PDO storage implementation
 * LICENCE
 *   The MIT License
 *
 * @author derhaa
 * @category   Data access layer
 * @package    Storage
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 *
 * @deprecated
 */
class PDOStorage implements Storage {
	private $_defaultFetchMode = \PDO::FETCH_OBJ;
	/**
	 * @see \Mokos\Model\Storage\Storage::insert()
	 * @param $data \Mokos\Model\Storage\PDO\SqlDescriptor
	 */
	public function insert($data) 
        {
		$datas = $data->getColumns();
		$query = $this->prepareInsertQuery($data->getTableName(), array_keys($datas));
		return $this->executeQuery($query, array_values($datas))->fetch($this->_defaultFetchMode);
	}
	/**
	 * @see \Mokos\Model\Storage\Storage::update()
	 * @param $data \Mokos\Model\Storage\PDO\SqlDescriptor
	 */
	public function update($data) 
        {
		$datas = $data->getColumns();
		$criterias = $data->getConditions();
		$query = $this->prepareUpdateQuery($data->getTableName(), array_keys($datas), array_keys($criterias));
		$params = array_merge(array_values($datas), array_values($criterias));
		$this->executeQuery($query, $params);
	}
	/**
	 * @see \Mokos\Model\Storage\Storage::delete()
	 * @param $data \Mokos\Model\Storage\PDO\SqlDescriptor
	 */
	public function delete($data) 
        {
		$datas = $data->getColumns();
		$criterias = $data->getConditions();            
		$query = $this->prepareDeleteQuery($data->getTableName(), $data->getColumns());
                $params = array_merge(array_values($datas), array_values($criterias));
		$this->executeQuery($query, $params);
	}
	/**
	 * @see \Mokos\Model\Storage\Storage::deleteAll()
         * @param $data \Mokos\Model\Storage\PDO\SqlDescriptor
	 */
	public function deleteAll($data) 
        {
		$this->executeQuery("DELETE FROM ".$data->getTableName(), array());
	}        
	/*
	 * (non-PHPdoc)
	 * @see \Mokos\Model\Storage\Storage::fetchAll()
	 */
	public function fetchAll($query, array $params = array()) 
        {
		return $this->executeQuery($query, $params);
	}
	/*
	 * (non-PHPdoc)
	 * @see \Mokos\Model\Storage\Storage::query()
	 */
	public function query($query) 
        {
		return $this->executeQuery($query, null)->fetchAll();
	}
	/*
	 * Build insert sql query
	 * @param string $tableName
	 * @param array $columns name of columns
	 * @return string sql query
	 */
	private function prepareInsertQuery($tableName, array $columns) 
        {
		$placeholders = array();
                for ($index = 0; $index < count($columns); $index++) {
                    $placeholders[] = '?';
                }
		$query = 'INSERT INTO ' . $tableName . ' (' . implode(', ', $columns) . ')' . ' VALUES (' . implode(', ', $placeholders) . ')';
		return $query;
	}
	/*
	 * Builds update sql query
	 * @param string $tableName
	 * @param array $columns name of updated columns
	 * @param array $criteria update criteria for where clauzule
	 * @return string
	 */
	private function prepareUpdateQuery($tableName, array $columns, array $criterias) 
        {
		$set = array();
		foreach ($columns as $column) {
			$set[] = $column . ' = ?';
		}
		$identifiers = array();
		foreach ($criterias as $criteria) {
			$identifiers[] = $criteria . ' = ?';
		}
		$query = 'UPDATE ' . $tableName . ' SET ' . implode(', ', $set) . ' WHERE (' . implode(' = ? AND ', $identifiers) . ')';
		return $query;
	}
	/*
	 * 
	 * @param string $tableName
	 * @param array $columns
	 * @return string
	 */
	private function prepareDeleteQuery($tableName, array $columns)
	{
		$identifiers = array();
		foreach ($columns as $column => $value) {
			$identifiers[] = $column . ' = ' . $column[$value];
		}		
		$query = 'DELETE FROM ' .$tableName . ' WHERE (' . implode(' AND ', $identifiers) . ')';
		return $query;
	}
	/*
	 * Execute sql query
	 * @param string $query sql query
	 * @param array $params list of parameters
	 * @throws Exception if query fails
	 * @return \PDOStatement
	 */
	private function executeQuery($query, $params) 
        {
		try {
			$statement = null;
			if(!$this->pdo->inTransaction()) $this->pdo->beginTransaction();
			if($params) {
				$statement = $this->pdo->prepare($query);
				$statement->execute($params);
			} else {
				$statement = $this->pdo->exec($query);
			}
			//$statement->setFetchMode($this->_defaultFetchMode);
			$statement->closeCursor();
			if($this->pdo->inTransaction())  $this->pdo->commit();
			return $statement;
		} catch (\Exception $e) {
			if($this->pdo->inTransaction()) $this->pdo->rollBack();
			throw $e;
		}
	}
	/**
	 * PDO implementation
	 * @var \PDO
	 */
	private $pdo;
	/**
	 * Injection of pdo implementation
	 * @param \PDO $pdo
	 */
	public function __construct(\PDO $pdo) 
        {
		$this->pdo = $pdo;
	}
}