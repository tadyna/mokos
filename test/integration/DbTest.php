<?php
/**
 * Description of DbTest. Test class and its implementation is inspired by official PHPUnit.de
 * manual.
 * @author derhaa
 */
abstract class DbTest extends PHPUnit_Extensions_Database_TestCase
{
    /**
     * Only instantiate pdo once for test clean-up/fixture load
     * @var PDO 
     */
    private static $pdo = null;
    /**
     * Only instantiate PHPUnit_Extensions_Database_DB_IDatabaseConnection once per test
     * @var PHPUnit_Extensions_Database_DB_IDatabaseConnection 
     */
    private $conn = null;
    /**
     * Only instantiate PHPUnit_Extensions_Database_DataSet_IDataSet once per test
     * @var PHPUnit_Extensions_Database_DataSet_IDataSet 
     */
    private $dataset = null;
    /**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */    
    protected function getConnection() 
    {
        if ( $this->conn === null ) 
        {
            if (self::$pdo == null) self::$pdo = new PDO('sqlite::memory:');
            $this->conn = $this->createDefaultDBConnection(self::$pdo, ':memory:');
        }
        return $this->conn;       
    }
    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    protected function getDataSet() 
    {
        if ( $this->dataset === null ) $this->dataset = $this->createFlatXMLDataSet(__DIR__.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.get_class().'.xml');
        return $this->dataset;
    }
}

