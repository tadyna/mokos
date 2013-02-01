<?php
namespace Mokos\Model\Storage\PDO;
/**
 * Basic interface for sql query
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
class SqlQuery 
{
	/**
	 * @var string sql query
	 */
	private $query;
	/**
	 * @var array parameters of sql query as associative array condition-value pairs
	 */
	private $conditions;
	public function __construct($query, $conditions = array()) 
	{
		$this->query = $query;
		$this->conditions = $conditions;
	}
	/**
	 * @return string sql query
	 */
	public function getQuery() 
        {
		return $this->query;
	}
	/**
	 * @return array associative array condition-value pair
	 */
	public function getConditions() 
        {
		return $this->conditions;
	}	
}