<?php
require_once '/../../DatabaseTestBase.php';
use Mokos\Database\Adapter\AdapterMysql;
/**
 * @author tomascejka
 */
class AdapterMysqlTest extends \DatabaseTestBase
{
    /**
     * @var string name of testing table
     */
    private static $tableName = 'person_in_organization';
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
     * @see PHPUnit\Extensions\Database\TestCase::getDataSet
     */
    protected function getDataSet()
    {
        return $this->createFlatXMLDataSet($this->pathResources.DIRECTORY_SEPARATOR.'Database'.DIRECTORY_SEPARATOR.'adapterMysqlTest.xml');
    }	
    /**
     * Test if names of tables are equals
     */
    public function testGetAllTables()
    {
            $names = array();
            $query = "select * from information_schema.tables where table_schema='".$this->configuration->getDbName()."'";
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
            $expectedRow = array('ID_PERSON'=>'1', 'FULLNAME'=>'Tomas Cejka');
            $queryRow = $queryTable->getRow(0); 
            return $this->assertEquals($expectedRow, $queryRow, "Rows are not equals");
    }
}