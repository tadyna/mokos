<?php
require_once 'PHPUnit/Extensions/Database/TestCase.php';
use Mokos\Model\Storage\PDO\PDOStorage;
use Mokos\Model\Storage\SqlDescriptor;
/**
 * 
 * @author derhaa
 *
 */
class PDOStorageTest extends PHPUnit_Extensions_Database_TestCase 
{
	private static $TABLE_NAME = 'PERSON';
	private static $ID_PERSON = 999;
	/**
	 * @var PDO
	 */	
	protected $pdo;
	/**
	 * @var PDOStorage
	 */
	private $testedObject;
	
	public function __construct()
	{
		$this->pdo = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
		$this->testedObject = new PDOStorage($this->pdo);
	}
	
	protected function getConnection()
	{
		return $this->createDefaultDBConnection($this->pdo, $GLOBALS['DB_DBNAME']);
	}
	
	protected function getDataSet()
	{
		return $this->createFlatXMLDataSet(dirname(__FILE__).'/person-seed.xml');
	}

	protected function getSetUpOperation()
	{
		return $this->getOperations()->CLEAN_INSERT();
	}	
	
	public function testCreatePerson()
	{
		$data = array('ID_PERSON'=>3, 'FULLNAME'=>'Nikodim Michal');
		$descriptor = new SqlDescriptor(self::$TABLE_NAME, $data);
		$o =  $this->testedObject->insert($descriptor);		
	
		$xml_dataset = $this->createFlatXMLDataSet(dirname(__FILE__).'/person-after-new-person.xml');
		$this->assertDataSetsEqual($xml_dataset, $this->getConnection()->createDataSet());
	}

	public function testUpdatePerson()
	{
		$data = array('FULLNAME'=>'Karolina Malkova UPD');
		$descriptor = new SqlDescriptor(self::$TABLE_NAME, $data, array('ID_PERSON'=>2));
		$this->testedObject->update($descriptor);
	
		$xml_dataset = $this->createFlatXMLDataSet(dirname(__FILE__).'/person-after-update-person.xml');
		$this->assertDataSetsEqual($xml_dataset, $this->getConnection()->createDataSet());
	}	
}
