<?php
use Mokos\Generator\BaseGenerator;
use Mokos\Database\AdapterMysql;
use Mokos\Template\Template;
/**
 * @author tocecz
 *
 */
class BaseGeneratorTest extends \PHPUnit_Framework_TestCase {
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
	public function __construct() {
		$pdo = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
		$this->adapter = new AdapterMysql($pdo, $GLOBALS['DB_DATABASE']);
	}
	/*
	 * (non-PHPdoc)
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	public function setUp() {
		$this->mock = new BaseGeneratorMock(__DIR__ . DIRECTORY_SEPARATOR . 'DOMAIN.tpl', __DIR__, $this->adapter);
	}
	/**
	 * Test generate process... without asserting, only for exception
	 */
	public function testGenerate() {
		$this->mock->generate();
		return $this->assertEquals(1, 1);
	}
}
/**
 * 
 * @author tocecz
 * @property Mokos\Generator\BaseGenerator
 */
class BaseGeneratorMock extends BaseGenerator {
	protected function _fill(Template $template, $tableName, $tableDescription) {

	}

	protected function _getType() {

	}
}
