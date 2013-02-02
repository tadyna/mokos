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
    private $mock;
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
        $this->mock = new \Mokos\Generator\GeneratorSimple(
                $this->pathTemplateDir.'DOMAIN.tpl',
                $this->pathTemporaryDir, 
                'Entity');        
    }
    /**
     * Test generate process... without asserting, only for exception
     */
    public function testGenerate() 
    {
        $this->mock->generate();
    }
}