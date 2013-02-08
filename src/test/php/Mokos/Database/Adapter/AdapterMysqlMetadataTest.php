<?php
require_once '/../../IntegrationTest.php';
use Mokos\Database\Adapter\AdapterMysql;
/**
 * @author tomascejka
 */
class AdapterMysqlMetadataTest extends IntegrationTest
{
    /**
     * @var Mokos\Database\Adapter\AdapterMysql
     */
    private $adapter;
    /**
     * Create Mokos\Database\AdapterMysql and init filepath to resources
     */
    public function __construct()
    {
        parent::__construct();
        $this->adapter = new AdapterMysql($this->configuration);
    }	
    /*
     * (non-PHPdoc)
     * @see DatabaseTestBase::getDirectoryName()
     */
    public function getDirectoryName()
    {
        return __DIR__;
    }
    /**
     * Test if tables with primary keys has been returned
     */
    public function testCheckIfTableHasPrimaryKey () 
    {
        $tables = $this->adapter->getTablesWithPrimaryKey();
        $names = array('person_basic_data', 'book', 'person');
        foreach ($names as $name) {
            $this->assertTrue(array_key_exists($name, $tables), "Table with name '".$name."' has no primary key ");
        }
        $this->assertEquals(count($tables), 3);
    }
    /**
     * Test loading/parsing metadata
     */
    public function testGetRelations()
    {
        $relations = $this->adapter->getRelations();   
        foreach ($relations as $table => $methods) {
            foreach ($methods as $method) {
                
            }
        };
       
    }    
}