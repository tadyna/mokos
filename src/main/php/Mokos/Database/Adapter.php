<?php
namespace Mokos\Database;
use Mokos\Database\Column;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author tomascejka
 * @category   Database
 * @package    Database
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 *
 * Base interface of database table rules
 */
interface Adapter 
{
	/**
	 * Return array of descriptors of table column
	 * @return array Mokos\Database\Column objects
	 */
	public function getAllFields($tableName);
	/**
	 * Return array of descriptors of database table
	 * @return array Mokos\Database\Table objects
	*/
	public function getAllTables();
	/**
	 * Return mapped type of column as string
	 * @return string data type as string
	*/
	public function getType(Column $columnDescriptor);
}