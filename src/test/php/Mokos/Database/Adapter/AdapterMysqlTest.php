<?php
require_once '/../../IntegrationTest.php';
use Mokos\Database\Adapter\AdapterMysql;
/**
 * @author tomascejka
 */
class AdapterMysqlTest extends \IntegrationTest
{
    /**
     * @var string name of testing table
     */
    private static $tableName = 'person';
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
     * Test if names of tables are equals
     */
    public function testGetAllTables()
    {
            $names = array();
$query="
        select t.table_name as TABLE_NAME, t.table_comment as TABLE_COMMENT, c.column_name, c.column_key 
        from information_schema.tables as t, information_schema.columns as c
        where
            c.table_schema='".$this->configuration->getDbName()."' 
            and t.table_name=c.table_name
            and c.column_key='PRI';"; 
            //$query = "select * from information_schema.tables where table_schema='".$this->configuration->getDbName()."'";
            foreach($this->configuration->getConnection()->query($query) as $table){
                    $names[0] = $table['TABLE_NAME'];
                    $names[1] = $table['TABLE_COMMENT'];
            }		
            $tables = $this->adapter->getAllTables();
            $names2 = array();
            foreach($tables as $table){
                    $names2[0] = $table->getName();
                    $names2[1] = $table->getDescription();
            }
            return $this->assertEquals($names, $names2);
    }
    /**
     * Test if table columns are equals
     */
    public function testGetAllFields()
    {
        $ds = new PHPUnit_Extensions_Database_DataSet_QueryDataSet($this->getConnection());
        $ds->addTable(self::$tableName);

        $queryTable = $ds->getTable(self::$tableName);
        $expectedTable = $this->getDataSet()->getTable(self::$tableName);
        $this->assertTablesEqual($expectedTable, $queryTable);

        $this->assertEquals(2, $this->getConnection()->getRowCount(self::$tableName), "Wrong count of rows in table ".self::$tableName);
        $expectedRow = array('ID_PERSON'=>'1', 'FULLNAME'=>'Tomas Cejka', 'FIRST_NAME'=>'Tomas', 'LAST_NAME'=>'Cejka', 'ADDRESS'=>'', 'CITY'=>'');
        $queryRow = $queryTable->getRow(0); 
        return $this->assertEquals($expectedRow, $queryRow, "Rows are not equals");
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
     * Test relations metadata data mining
     */
    public function testGetRelations()
    {
        //todo test...
    }
}
