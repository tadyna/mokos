<?php
require_once '/../vendor/autoload.php';
require_once "PHPUnit/Extensions/Database/TestCase.php";
/**
 * Inspired by phpunit manual
 * @author derhaa
 */
abstract class AbstractDbTest extends \PHPUnit_Extensions_Database_TestCase {
	// only instantiate pdo once for test clean-up/fixture load
	protected static $pdo = null;
	// only instantiate PHPUnit_Extensions_Database_DB_IDatabaseConnection once per test
	private $conn = null;
	
	public function __construct() {
		
	}
	/*
	 * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
	 */
	public function getConnection() {
		if ($this->conn === null) {
			$this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_DBNAME']);
		}
		return $this->conn;
	}
	/*
	 * (non-PHPdoc)
	 * @see PHPUnit_Extensions_Database_TestCase::setUp()
	 */
	public function setUp() {
		if (self::$pdo === null) {
			self::$pdo = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
		}		
		parent::setUp();
	}
	/*
	 * @return PHPUnit_Extensions_Database_DataSet_IDataSet
	 */
	public function getDataSet() {
		$fileName = $this->getDataSetPath();
		if($fileName == null) return new PHPUnit_Extensions_Database_DataSet_DefaultDataSet();
		$filepath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . $fileName;
		return $this->createFlatXMLDataSet($filepath);
	}
	/**
	 * File path to xml file with data for database tables
	 * @return string filepath
	 */
	protected function getDataSetPath() {
		return null;
	}
}
