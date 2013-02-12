<?php
require_once '/../UnitTestBase.php';
use Mokos\Database\Adapter\AdapterMysql;
/**
 * @author tomascejka
 */
class GeneratorAllTest extends \UnitTestBase 
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
     * Generator for simple template
     * @var Mokos\Generator\Generator\GeneratorCollection
     */
    private $mock9;     
    /**
     * Generator for simple template
     * @var Mokos\Generator\Generator\GeneratorCollection
     */
    private $mock10;
    /**
     * Generator for simple template
     * @var Mokos\Generator\Generator\GeneratorCollection
     */
    private $mock11; 
    /**
     * Generator for simple template
     * @var Mokos\Generator\Generator\GeneratorCollection
     */
    private $mock12;
    /**
     * Generator for simple template
     * @var Mokos\Generator\Generator\GeneratorCollection
     */
    private $mock13;    
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
        $this->mock9 = new \Mokos\Generator\GeneratorDomain2Dto(
                $this->pathTemplateDir.'CONVERT_DOMAIN_2_DTO.tpl',
                $this->pathTemporaryDir, 
                '',
                $this->adapter);  
        $this->mock10 = new \Mokos\Generator\GeneratorDto2Domain(
                $this->pathTemplateDir.'CONVERT_DTO_2_DOMAIN.tpl',
                $this->pathTemporaryDir, 
                '',
                $this->adapter);
        $this->mock11 = new \Mokos\Generator\GeneratorDto(
                $this->pathTemplateDir.'DTO_IMPL.tpl',
                $this->pathTemporaryDir, 
                '',
                $this->adapter);
        $this->mock12 = new \Mokos\Generator\GeneratorRepository(
                $this->pathTemplateDir.'REPOSITORY.tpl',
                $this->pathTemporaryDir, 
                '',
                $this->adapter);
        $this->mock13 = new \Mokos\Generator\GeneratorService(
                $this->pathTemplateDir.'SERVICE.tpl',
                $this->pathTemporaryDir, 
                '',
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
        $this->mock5->generate();
        $this->mock6->generate();
        $this->mock7->generate();
        $this->mock8->generate();        
        $this->mock9->generate();
        $this->mock10->generate();
        $this->mock11->generate();
        $this->mock12->generate();
        $this->mock13->generate();
    }
}