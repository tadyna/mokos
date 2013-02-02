<?php
require_once '/../UnitTestBase.php';
use Mokos\Generator\GeneratorBase;
use Mokos\Database\Adapter\AdapterMysql;
use Mokos\Template\Template;
/**
 * @author tomascejka
 */
class GeneratorBaseTest extends \UnitTestBase {
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
        parent::__construct();
        $this->adapter = new AdapterMysql($this->configuration);
    }
    /*
     * (non-PHPdoc)
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp() 
    {
        $this->mock = new BaseGeneratorMock(
                null, 
                $this->pathTemporaryDir,
                '',
                $this->adapter);
    }
    /**
     * Test generate clazz name
     */
    public function testGetClazzName() 
    {
        $clazzName = $this->mock->getClazzName('person_in_organization_by_default_for_test');
        $this->assertEquals('PersonInOrganizationByDefaultForTest', $clazzName);
    }
}
/**
 * @author tomascejka
 * @property Mokos\Generator\BaseGenerator
 */
class BaseGeneratorMock extends GeneratorBase 
{
	protected function fill(Template $template, $tableName, $tableDescription) {}
	protected function getType() {}
}
