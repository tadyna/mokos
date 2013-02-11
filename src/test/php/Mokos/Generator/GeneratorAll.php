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
     * Generator for simple template
     * @var Mokos\Generator\Generator\GeneratorCollection
     */
    private $mock4; 
    /**
     * Generator for simple template
     * @var Mokos\Generator\Generator\GeneratorCollection
     */
    private $mock5; 
    /**
     * Generator for simple template
     * @var Mokos\Generator\Generator\GeneratorCollection
     */
    private $mock6;
    /**
     * Generator for simple template
     * @var Mokos\Generator\Generator\GeneratorCollection
     */
    private $mock7; 
    /**
     * Generator for simple template
     * @var Mokos\Generator\Generator\GeneratorCollection
     */
    private $mock8;     
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
        $this->mock2 = new \Mokos\Generator\GeneratorEntity(
                $this->pathTemplateDir.'DOMAIN_IMPL.tpl',
                $this->pathTemporaryDir, 
                '',
                $this->adapter);
        $this->mock3 = new \Mokos\Generator\GeneratorMapper(
                $this->pathTemplateDir.'MAPPER.tpl',
                $this->pathTemporaryDir,
                '',
                $this->adapter);
        $this->mock4 = new \Mokos\Generator\GeneratorMapper(
                $this->pathTemplateDir.'MAPPER_IMPL.tpl',
                $this->pathTemporaryDir,
                'Impl',
                $this->adapter);
        $this->mock5 = new \Mokos\Generator\GeneratorRepository(
                $this->pathTemplateDir.'REPOSITORY_IMPL.tpl',
                $this->pathTemporaryDir, 
                'Impl',
                $this->adapter);  
        $this->mock6 = new \Mokos\Generator\GeneratorService(
                $this->pathTemplateDir.'SERVICE_IMPL.tpl',
                $this->pathTemporaryDir, 
                'Impl',
                $this->adapter);
        $this->mock7 = new \Mokos\Generator\GeneratorSimple(
                $this->pathTemplateDir.'DOMAIN.tpl',
                $this->pathTemporaryDir, 
                'Entity');
        $this->mock8 = new \Mokos\Generator\GeneratorSimple(
                $this->pathTemplateDir.'COLLECTION_BASE.tpl',
                $this->pathTemporaryDir, 
                'Collection');        
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
        $this->mock5->generate();
        $this->mock6->generate();
        $this->mock7->generate();
        $this->mock8->generate();        
    }
}