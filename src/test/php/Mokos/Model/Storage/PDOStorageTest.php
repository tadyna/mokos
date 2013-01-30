<?php
require_once '/../DatabaseTestBase.php';
use Mokos\Model\Storage\PDO\PDOStorage;
use Mokos\Model\Storage\PDO\SqlDescriptor;
/**
 * 
 * @author derhaa
 *
 */
class PDOStorageTest extends \DatabaseTestBase 
{
	private static $TABLE_NAME = 'person_in_organization';
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
		parent::__construct();
		$this->testedObject = new PDOStorage($this->pdo);
	}
	/*
         * (non-PHPdoc)
         * @see PHPUnit\Extensions\Database\TestCase::getDataSet
        */
	protected function getDataSet()
	{
		return $this->createFlatXMLDataSet(dirname(__FILE__).'/person-seed.xml');
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
