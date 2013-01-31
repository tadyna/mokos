<?php
require_once '/../PdoFactory.php';
require_once '/../UnitTestBase.php';
use Mokos\Database\AdapterMysql;
/**
 * @author tomascejka
 */
class GeneratorEntityTest extends \UnitTestBase 
{
	/**
	 * @var Mokos\Generator\Generator
	 */
	private $mock;
	/**
	 * @var Mokos\Database\Adapter
	 */
	private $adapter;
	/**
	 * create \PDO object and Mokos\Database\Adapter object
	 */
	public function __construct() 
        {
            $this->adapter = new AdapterMysql(\PdoFactory::createConnection(), \PdoFactory::getDatabaseName());
	}
	/*
	 * (non-PHPdoc)
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	public function setUp() 
        {
            $this->mock = new \Mokos\Generator\GeneratorEntity(
                    $this->pathTemplateDir.'DOMAIN.tpl',
                    $this->pathTemporaryDir, 
                    $this->adapter);
	}
	/**
	 * Test generate process... without asserting, only for exception
	 */
	public function testGenerate() {
		$this->mock->generate();
	}
}
