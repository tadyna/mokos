<?php
require_once '/../../../AbstractDbTest.php';
use Mokos\Model\Storage\PDO\PDOStorage;
use Mokos\Model\Storage\SqlDescriptor;
/**
 * 
 * @author tomascejka
 */
class PDOStorageDbTest extends \AbstractDbTest  {
	private static $TABLE_NAME = 'PERSON   ';
	private static $ID_PERSON = 999;
	/**
	 * @var \Mokos\Model\Storage\PDOStorage
	 */
	private $testedObject;
	/*
	 * (non-PHPdoc)
	 * @see PHPUnit_Extensions_Database_TestCase::setUp()
	 */
	public function setUp()
	{
		parent::setUp();
		//clean first
		$query = "DROP TABLE IF EXISTS ".self::$TABLE_NAME.";";
		self::$pdo->exec($query);
		//prepare table for test
		$query = "
			CREATE TABLE ".self::$TABLE_NAME." (
			    ID_PERSON   INT NOT NULL,
			    FULLNAME    VARCHAR(150) NOT NULL,
			    CONSTRAINT PRIMARY KEY (ID_PERSON)
			);"
		;
		self::$pdo->query($query);
		//prepare tested object
		$this->testedObject = new PDOStorage();
		$this->testedObject->setPDO(self::$pdo);
	}
	/*
	 * (non-PHPdoc)
	 * @see PHPUnit_Extensions_Database_TestCase::tearDown()
	 */
	protected function tearDown() {
		parent::tearDown();
		$query = "DROP TABLE IF EXISTS ".self::$TABLE_NAME.";";
		self::$pdo->exec($query);	
	}
	/**
	 * Test if PDO storage implementation construct correct insert query 
	 */
	public function testInsert() {
		$data = array();
		$data['ID_PERSON']=self::$ID_PERSON;
		$data['FULLNAME']='Kaja';
		$descriptor = new SqlDescriptor(self::$TABLE_NAME, $data);
		$insertedObject = $this->testedObject->insert($descriptor);
		
        $statement = self::$pdo->prepare("SELECT * FROM ".self::$TABLE_NAME." WHERE ID_PERSON = ?");
        $statement->execute(array(self::$ID_PERSON));
		$o = $statement->fetch();
		return $this->assertNotEmpty($o,"Statement is empty");
	}
	/**
	 * Test if PDO storage implementation construct correct insert query
	 */
	public function testUpdate() {
		//first insert data
		$insert = self::$pdo->prepare("INSERT INTO ".self::$TABLE_NAME."(ID_PERSON,FULLNAME) VALUES (?,?)");
		$insert->execute(array(self::$ID_PERSON, 'Karolina Malkova'));
		
		//testing update code - Kaja changes fullname because of she married me :-)
		$data = array();
		$data['FULLNAME']='Kaja Cejkova';
		$conditions = array('ID_PERSON'=>self::$ID_PERSON);
		$descriptor = new SqlDescriptor(self::$TABLE_NAME, $data, $conditions);
		$updatedObject = $this->testedObject->update($descriptor);
	
		//check if update was correct
		$statement = self::$pdo->prepare("SELECT * FROM ".self::$TABLE_NAME." WHERE FULLNAME = ?");
		$statement->execute(array('Kaja Cejkova'));
		$o = $statement->fetch();
		return $this->assertNotEmpty($o,"Statement is empty");
	}	
}