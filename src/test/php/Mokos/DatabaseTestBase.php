<?php
require_once 'Configuration.php';
/**
 * Basic interface for database/integration test subclass
 * @author derhaa
 */
abstract class DatabaseTestBase extends PHPUnit_Extensions_Database_TestCase
{
    /**
     * Look at /test/php/resources
     * @var string filepath to test directory
     */
    protected $pathTestDir;    
    /**
     * Look at /test/php/resources/Mokos
     * @var string filepath to resource directory 
     */
    protected $pathResources;
    /**
     * @var PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection
     */
    private $connection;
    /**
     * @var Mokos\Database\Configuration
     */
    protected $configuration;
    /**
     * Construct PDO object and init database settings
     */
    public function __construct() 
    {
        $this->pathTestDir = '..'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR;
        $this->pathResources = $this->pathTestDir.'Mokos'.DIRECTORY_SEPARATOR;
        $this->configuration = new Configuration();
    } 
    /**
     * Create PDO object and create connection. It is create one time per test!
     * @return \PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection
     */
    protected function getConnection() 
    {
        if($this->connection === null ) {
            $this->connection = $this->createDefaultDBConnection($this->configuration->getConnection());
        }
        return $this->connection;
    }
    /**
     * @return \PHPUnit_Extensions_Database_Operation_Composite
     */
    protected function getSetUpOperation()
    {
        return $this->getOperations()->CLEAN_INSERT();
    }   
}