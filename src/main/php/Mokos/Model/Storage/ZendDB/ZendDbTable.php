<?php
namespace \Mokos\Model\Storage\ZendDB;
/**
 * Basic interface for Zend_DB_Table implementation
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
abstract class ZendDbTable extends Zend_Db_Table_Abstract 
{
	/**
	 * @var string name of database table
	 */
	private $_name;
	/**
	 * @var string name of private key
	 */
	private $_primary;
	/**
	 * @param string $tableName
	 * @param string $privateKey
	 */
	public function __construct($tableName, $privateKey) 
        {
		$this->_name = $tableName;
		$this->_primary = $privateKey;
	}
	/**
	 * @return string
	 */
	public function getName() {
		return $this->_name;
	}
	/**
	 * @return string
	 */
	public function getPrivateKey(){
		return $this->_primary;
	}
}