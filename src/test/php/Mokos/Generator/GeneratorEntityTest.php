<?php
use Mokos\Database\AdapterMysql;
/**
 * @author tocecz
 *
 */
class GeneratorEntityTest extends \PHPUnit_Framework_TestCase {
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
            $path = '..'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'DOMAIN.tpl';
            $this->mock = new \Mokos\Generator\GeneratorEntity($path, __DIR__, $this->adapter);
	}
	/**
	 * Test generate process... without asserting, only for exception
	 */
	public function testGenerate() {
		$this->mock->generate();
	}
}