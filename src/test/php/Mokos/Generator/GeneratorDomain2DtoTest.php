<?php
require_once '/../UnitTestBase.php';
use Mokos\Database\Adapter\AdapterMysql;
/**
 * @author tomascejka
 */
class GeneratorDomain2DtoTest extends \UnitTestBase 
{
    /**
     * Generator for simple template
     * @var Mokos\Generator\Generator
     */
    private $mock;
    /**
     * @var Mokos\Database\Adapter
     */
    private $adapter;
    /**
     * create Mokos\Database\Adapter object
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
        $this->mock = new \Mokos\Generator\GeneratorDomain2Dto(
                $this->pathTemplateDir.'CONVERT_DOMAIN_2_DTO.tpl',
                $this->pathTemporaryDir, 
                '',
                $this->adapter);        
    }
    /**
     * Test generate process... without asserting, only for exception
     */
    public function testGenerate() 
    {
        $this->mock->generate();
    }
}