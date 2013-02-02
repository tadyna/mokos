<?php
require_once '/../UnitTestBase.php';
use Mokos\Database\Adapter\AdapterMysql;
/**
 * @author tomascejka
 */
class GeneratorCollectionTest extends \UnitTestBase 
{
    /**
     * Generator for simple template
     * @var Mokos\Generator\Generator
     */
    private $mock1;
    /**
     * Generator for simple template
     * @var Mokos\Generator\Generator
     */
    private $mock2;
    /**
     * Generator for simple template
     * @var Mokos\Generator\Generator
     */
    private $mock3;
    /**
     * Generator for simple template
     * @var Mokos\Generator\Generator
     */
    private $mock4;    
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
        $this->mock1 = new \Mokos\Generator\GeneratorCollection(
                $this->pathTemplateDir.'COLLECTION.tpl',
                $this->pathTemporaryDir, 
                '',
                $this->adapter);
        $this->mock2 = new \Mokos\Generator\GeneratorCollection(
                $this->pathTemplateDir.'COLLECTION_BASE.tpl',
                $this->pathTemporaryDir, 
                'Base',
                $this->adapter);
        $this->mock3 = new \Mokos\Generator\GeneratorCollection(
                $this->pathTemplateDir.'COLLECTION_BASE_IMPL.tpl',
                $this->pathTemporaryDir, 
                'BaseImpl',
                $this->adapter);
        $this->mock4 = new \Mokos\Generator\GeneratorCollection(
                $this->pathTemplateDir.'COLLECTION_IMPL.tpl',
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
        $this->mock3->generate();
        $this->mock4->generate();
    }
}