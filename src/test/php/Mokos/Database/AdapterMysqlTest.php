<?php
use Mokos\Database\AdapterMysql;
/**
 * @author derhaa
 */
class AdapterMysqlTest extends PHPUnit_Extensions_Database_TestCase {
	/**
	 * @var string name of testing table
	 */
	private static $tableName = 'person_in_organization';
	/**
	 * @var Mokos\Database\AdapterMysql
	 */
	private $object;
	/**
	 * PDO implementation
	 * @var \PDO
	 */
	private $pdo;
	public function __construct()
	{
		$this->pdo = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
		$this->object = new AdapterMysql($this->pdo, $GLOBALS['DB_DATABASE']);
	}
	/*
	 * (non-PHPdoc)
	 * @see PHPUnit\Extensions\Database\TestCase::getConnection
	 */
	protected function getConnection()
	{
		return $this->createDefaultDBConnection($this->pdo, $GLOBALS['DB_DBNAME']);
	}
	/*
	 * (non-PHPdoc)
	 * @see PHPUnit\Extensions\Database\TestCase::getDataSet
	 */
	protected function getDataSet()
	{
		return $this->createFlatXMLDataSet(dirname(__FILE__).'/person-seed.xml');
	}
	/*
	 * (non-PHPdoc)
	 * @see PHPUnit\Extensions\Database\TestCase::getSetUpOperation
	 */
	protected function getSetUpOperation()
	{
		return $this->getOperations()->CLEAN_INSERT();
	}	
	/**
	 * Test if names of tables are equals
	 */
	public function testGetAllTables()
	{
		$names = array();
		$query = "select * from information_schema.tables where table_schema='".$GLOBALS['DB_DATABASE']."'";
		foreach($this->pdo->query($query) as $table){
			$names[0] = $table['TABLE_NAME'];
			$names[1] = $table['TABLE_COMMENT'];
		}		
		$tables = $this->object->getAllTables();
		$names2 = array();
		foreach($tables as $table){
			$names2[0] = $table->getName();
			$names2[1] = $table->getDescription();
		}	
		return $this->assertEquals($names, $names2);
	}
	/**
	 * Test if table columns are equals
	 */
	public function testGetAllFields()
	{
		$tables = $this->object->getAllTables();
		$fields = $this->object->getAllFields($tables[0]->getName());
		$ds = new PHPUnit_Extensions_Database_DataSet_QueryDataSet($this->getConnection());
		$ds->addTable(self::$tableName);
		
		$queryTable = $ds->getTable(self::$tableName);
		$expectedTable = $this->getDataSet()->getTable(self::$tableName);
		$this->assertTablesEqual($expectedTable, $queryTable);
		
		$this->assertEquals(2, $this->getConnection()->getRowCount(self::$tableName), "Wrong count of rows in table ".self::$tableName);
		$expectedRow = array('ID_PERSON'=>'1', 'FULLNAME'=>'Tomas Cejka');
		$queryRow = $queryTable->getRow(0); 
		return $this->assertEquals($expectedRow, $queryRow, "Rows are not equals");
	}
}