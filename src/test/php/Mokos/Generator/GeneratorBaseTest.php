<?php
use Mokos\Generator\GeneratorBase;
use Mokos\Database\AdapterMysql;
use Mokos\Template\Template;
/**
 * @author tocecz
 *
 */
class GeneratorBaseTest extends \PHPUnit_Framework_TestCase {
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
		$this->mock = new Mokos\Generator\GeneratorEntity(__DIR__ . DIRECTORY_SEPARATOR . 'DOMAIN.tpl', __DIR__, $this->adapter);
	}
	/**
	 * Test generate process... without asserting, only for exception
	 */
	public function testGenerate() {
		$this->mock->generate();
	}
        /**
         * Test generate clazz name
         */
        public function testGetClazzName() {
            $clazzName = $this->mock->getClazzName('person_in_organization_by_default_for_test');
            $this->assertEquals('PersonInOrganizationByDefaultForTest', $clazzName);
        }
}
/**
 * 
 * @author tocecz
 * @property Mokos\Generator\BaseGenerator
 */
class BaseGeneratorMock extends GeneratorBase {
	protected function fill(Template $template, $tableName, $tableDescription) {

	}

	protected function getType() {

	}
}
