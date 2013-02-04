<?php
require_once '/../UnitTestBase.php';
/**
 * @author tomascejka
 */
class GeneratorSimpleTest extends \UnitTestBase 
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
     * create Mokos\Database\Adapter object
     */
    public function __construct() 
    {
        parent::__construct();
    }
    /*
     * (non-PHPdoc)
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp() 
    {
        $this->mock1 = new \Mokos\Generator\GeneratorSimple(
                $this->pathTemplateDir.'DOMAIN.tpl',
                $this->pathTemporaryDir, 
                'Entity');
        $this->mock2 = new \Mokos\Generator\GeneratorSimple(
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
    }
}