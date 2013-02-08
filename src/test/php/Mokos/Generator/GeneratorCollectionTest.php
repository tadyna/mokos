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
    public function testCreateRelationsMethodsName()
    {
        $tables = $this->adapter->getTablesWithPrimaryKey();
        $methods = array();
        foreach ($this->adapter->getRelations() as $tableName => $columns){
            // if table has no primary key (eg. many2many table)
            if(array_search($tableName, $tables, true) == null) 
            {
                $inner = array();
                $counter1 = count($columns) - 1;
                foreach ($columns as $column) {
                    $methods[$columns[$counter1--]][] = "get_".$column."s";
                }
                $counter = 0;
                foreach ($columns as $column) {
                    $tab = $columns[$counter++];
                    $position = 0;
                    if(array_key_exists($tab, $methods)){
                        if(array_key_exists($position, $methods[$tab])) {
                            $methods[$tab][$position++].="_by_".$column."(#id_".$column.")";
                        }                       
                    }
                }
            } 
            // if table has primary key (eg. table with one2many relation(s))
            else 
            {
                $inner = array();
                foreach ($columns as $column) {
                    $inner[] = "get_".$tableName."s_by_".$column."(#id_".$column.")";
                }                
                $methods[$tableName] = $inner;
            }
        } 
        var_dump($methods);
    }
}