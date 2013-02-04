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
    private $object;
    /**
     * Create Mokos\Database\AdapterMysql and init filepath to resources
     */
    public function __construct()
    {
        parent::__construct();
        $this->object = new AdapterMysql($this->configuration);
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
                t.table_schema='mokos_test' 
                and c.table_schema='".$this->configuration->getDbName()."' 
                and t.table_name=c.table_name
                and c.column_key is not null 
                and c.column_key='PRI';";
            //$query = "select * from information_schema.tables where table_schema='".$this->configuration->getDbName()."'";
            foreach($this->configuration->getConnection()->query($query) as $table){
                    $names[0] = $table['TABLE_NAME'];
                    $names[1] = $table['TABLE_COMMENT'];
            }		
            $tables = $this->object->getAllTables();
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
     * Test loading/parsing metadata
     */
    public function testGetMetadata()
    {
        //$statement = "select constraint_name, table_name, column_name, referenced_table_name, referenced_column_name from information_schema.key_column_usage where table_schema='".$this->configuration->getDbName()."'";// and referenced_table_name is not null";
//        $result = $this->configuration->getConnection()->query($statement);
        $d = basename(dirname(__DIR__));
        $result = $this->configuration->getConnection()->query("show tables");
        var_dump($result);
    }
}