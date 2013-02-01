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
        $xx = realpath(__DIR__.'/../../');
        $statement = "select constraint_name, table_name, column_name, referenced_table_name, referenced_column_name from information_schema.key_column_usage where table_schema='".$this->configuration->getDbName()."' and referenced_table_name is not null";
        foreach ($this->configuration->getConnection()->query($statement) as $vv) {
            var_dump($vv[0]);
            var_dump($vv[1]);
            var_dump($vv[2]);
            var_dump($vv[3]);
            var_dump($vv[4]);
        }
        //var_dump($result);
    }
}