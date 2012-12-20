<?php
namespace Mokos\Model\Storage;
/**
 * Descriptor for sql metadata
 * LICENCE
 *   The MIT License
 *
 * @author derhaa
 * @category   Data access layer
 * @package    Storage
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 *
 */
class SqlDescriptor {
	/**
	 * Table name
	 * @var string
	 */
	private $tableName;
	/**
	 * associative array condition-value for where clausule
	 * @var array 
	 */
	private $conditions = array();
	/**
	 * associative array columnname-value
	 * @var array
	 */
	private $values = array();
	/**
	 * @param string $tableName
	 * @param array $values associative array column-value pairs
	 * @param array $conditions associative array column-value pairs for where clausule
	 * @param string $query
	 */
	public function __construct($tableName, $columns, $conditions=null) {
		$this->tableName = $tableName;
		$this->values = $columns;
		$this->conditions = $conditions;
	}
	/**
	 * @return string table name
	 */
	public function getTableName() {
		return $this->tableName;
	}
	/**
	 * @return array associative array condition-value pair
	 */
	public function getConditions() {
		return $this->conditions;
	}
	/**
	 * @return array associative array columnname-value pair
	 */
	public function getColumns() {
		return $this->values;
	}	
}
