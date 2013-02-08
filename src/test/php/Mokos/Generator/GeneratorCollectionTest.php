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
     * @var Mokos\Generator\Generator\GeneratorCollection
     */
    private $mock1;
    /**
     * Generator for simple template
     * @var Mokos\Generator\Generator\GeneratorCollection
     */
    private $mock2;
    /**
     * Generator for simple template
     * @var Mokos\Generator\Generator\GeneratorCollection
     */
    private $mock3;   
    /**
     * @var Mokos\Database\Adapter\Adapter
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
                $this->pathTemplateDir.'COLLECTION_BASE_IMPL.tpl',
                $this->pathTemporaryDir, 
                'Impl',
                $this->adapter);        
        $this->mock3 = new \Mokos\Generator\GeneratorCollection(
                $this->pathTemplateDir.'COLLECTION_INTERFACE.tpl',
                $this->pathTemporaryDir, 
                'Interface',
                $this->adapter);         
    }
    /**
     * Test generate process... without asserting, only for exception
     */
    public function testGenerate() 
    {
        $this->mock1->generate();
        $this->mock2->generate();
        //$this->mock3->generate();
    }
}