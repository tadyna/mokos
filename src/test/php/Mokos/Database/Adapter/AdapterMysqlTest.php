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
//        $tables = $this->adapter->getRelations();
//        $names = array('person_basic_data', 'book', 'person');
//        foreach ($names as $name) {
//            $this->assertTrue(array_key_exists($name, $tables), "There is not table with name '".$name."' in metadata described relationship between database tables. ");
//        }
//        $this->assertEquals(count($tables), 3);
        $foreignKeys = $this->adapter->getTablesWithPrimaryKey();
        $tables = array();
        $result = $this->configuration->getConnection()->query("select u.table_name, u.column_name, u.referenced_table_name, u.referenced_column_name from information_schema.key_column_usage u
                    where u.table_schema='mokos_test'
                    and u.referenced_table_name is not null");  
        foreach ($result as $record) {
            $name = $record[0];
            $column = $record[1];//name of "filterColumn", eg. ByPersonId
            $ref = $record[2];//if many2many need referenced table name
            $refCol = $record[3];
//            $rels[] = new \Relationship( new Table($name, null, array($column)), $column, new Table($refTable, null, array($refCol)), $refCol);
            $tableName = $name;//array_key_exists($name, $foreignKeys) ? $name : $ref;
            if(array_key_exists($tableName, $tables)) {
                $tables[$tableName]->addColumn($refCol);
            } else {
                $tables[$tableName] = new Mokos\Database\Metadata\Table($tableName, null, array($refCol));
            }
        }
        //var_dump($tables);
        $methods = array();
        foreach ($tables as $tableName => $table){
            // if table has no primary key (eg. many2many table)
            $columns = $table->getColumns();
            if(array_search($tableName, $foreignKeys, true) == null) 
            {
                $inner = array();
                $counter = count($columns) - 1;
                foreach ($columns as $column) {
                    $cIndex = $columns[$counter--];
                    $methods[$cIndex][] = "get_".$column."";
                }
                $counter1 = 0;
                foreach ($columns as $column) {
                    $tab = $columns[$counter1++];
                    $position = 0;
                    if(array_key_exists($tab, $methods)){
                        if(array_key_exists($position, $methods[$tab])) {
                            $methods[$tab][$position++].="s_by_".$column."(#id_".$column.");";
                        }                       
                    }
                }
            } 
            // if table has primary key (eg. table with one2many relation(s))
            else 
            {
                $inner = array();
                foreach ($columns as $column) {
                    $inner[] = "get_".$tableName."s_by_".$column."(#id_".$column.");";
                }                
                $methods[$tableName] = $inner;
            }
        }
        var_dump($methods);
        return $tables;        
    }
}
