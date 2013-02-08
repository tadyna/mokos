<?php
require_once '/../../IntegrationTest.php';
use Mokos\Database\Adapter\AdapterMysql;
/**
 * @author tomascejka
 */
class AdapterMysqlMetadataTest extends IntegrationTest
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
     * @see DatabaseTestBase::getDirectoryName()
     */
    public function getDirectoryName()
    {
        return __DIR__;
    }    
    /**
     * Test loading/parsing metadata
     */
    public function testGetMetadata()
    {
//        $statement = "select constraint_name, table_name, column_name, referenced_table_name, referenced_column_name from information_schema.key_column_usage where table_schema='".$this->configuration->getDbName()."' and referenced_table_name is not null";
//*
$statement="
select c.column_key, c.column_name, u.table_name, u.referenced_column_name, u.referenced_table_name

from information_schema.key_column_usage as u, information_schema.columns as c
where
  u.table_schema='mokos_test'
  and u.referenced_table_name is not null
  and u.referenced_column_name is not null
  and c.column_key is not null 
  and c.column_name=u.column_name;";
//*/
        $v = array();
        $result = $this->configuration->getConnection()->query($statement);  
        foreach ($result as $record) {
            $table = $record[1];
            if(array_key_exists($table, $v)) {
                $v[$table][]= $record[3];
            } else {
                $v[$table] = array($record[3]);
            }
        }
        var_dump($v);
        //kazdy prvek musi pracovat s ostatnimy ... nikdy ne sam se sebou, tim ziskam getAllPersonsByBook a obracene getAllBooksByPerson
    }    
}