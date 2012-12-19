<?php
use Mokos\Database\AdapterMysql;
require_once '/../../../vendor/autoload.php';
/**
 * 
 * @author derhaa
 */
class AdapterMysqlTest extends \PHPUnit_Framework_TestCase {
	/**
	 * @var Mokos\Database\AdapterMysql
	 */
	private $object;
	/**
	 * PDO implementation
	 * @var \PDO
	 */
	private $pdo;	
	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{	
		if($this->pdo != null) {
			$this->object = new AdapterMysql($this->pdo);
		} else {
			$dns = 'mysql:dbname=sima;host=127.0.0.1';
			$user = 'root';
			$password = '';
			$this->pdo = new PDO($dns, $user, $password);
			$this->object = new AdapterMysql($this->pdo);
		}
	}
	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{
	}
	/**
	 * Test if names of tables are equals
	 */
	public function testGetAllTables()
	{
		$names = array();
		foreach($this->pdo->query('show tables') as $table){
			$names[] = $table[0];
		}		
		$tables = $this->object->getAllTables();
		$names2 = array();
		foreach($tables as $table){
			$names2[] = $table->getName();
		}	
		return $this->assertEquals($names, $names2);
	}
	/**
	 * Test if table columns are equals
	 */
	public function testGetAllFields()
	{//TODO [derhaa] finish test ...
		$tables = $this->object->getAllTables();
		$fields = $this->object->getAllFields($tables[0]->getName());
		return $this->assertEquals(1, 1);
	}
}