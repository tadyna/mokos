<?php
namespace Mokos\Database;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author derhaa
 * @category   Database
 * @package    Database
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 *
 * Descriptor of table
 */
class Table {
	/**
	 * @var string table name
	 */
	private $name;
	/**
	 * Descriptor of database table
	 */
	public function __construct($tableName) {
		$this->name = $tableName;
	}
	/**
	 * Return name of database table
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
}