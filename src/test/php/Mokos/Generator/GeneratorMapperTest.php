<?php
require_once '/../UnitTestBase.php';
use Mokos\Database\Adapter\AdapterMysql;
/**
 * @author tomascejka
 */
class GeneratorMapperTest extends \UnitTestBase 
{
    /**
     * Generator for normal template
     * @var Mokos\Generator\Generator
     */
    private $mock1;
    /**
     * Generator for mokos-based template
     * @var Mokos\Generator\Generator
     */
    private $mock2;    
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
        $this->mock1 = new \Mokos\Generator\GeneratorMapper(
                $this->pathTemplateDir.'MAPPER.tpl',
                $this->pathTemporaryDir,
                '',
                $this->adapter);
        $this->mock2 = new \Mokos\Generator\GeneratorMapper(
                $this->pathTemplateDir.'MAPPER_IMPL.tpl',
                $this->pathTemporaryDir,
                'Impl',
                $this->adapter);         
    }
    /**
     * Test generate process... without asserting, only for exception
     */
    public function testGenerate() 
    {
        $this->mock1->generate();
        $this->mock2->generate();
    }
}