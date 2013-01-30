<?php
/**
 * Basic interface for database/integration test subclass
 * @author derhaa
 */
abstract class DatabaseTestBase extends \PHPUnit_Extensions_Database_TestCase 
{
    /**
     * PDO implementation
     * @var \PDO
     */
    protected static $pdo;
    /**
     * @var string name of database
     */
    protected $database; 
    /**
     * @var string filepath to resource dir 
     */
    protected $pathResources;
    /**
     * @return \PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection
     */
    private $connection;
    /**
     * Construct PDO object and init database settings
     */
    public function __construct() 
    {
        self::$pdo = new \PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
        $this->database = $GLOBALS['DB_DATABASE'];
        $this->pathResources = '..'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'datasets'.DIRECTORY_SEPARATOR;
    }
    /**
     * Create PDO object and create connection. It is create one time per test!
     * @return \PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection
     */
    protected function getConnection() 
    {
        if($this->connection === null ) {
            $this->connection = $this->createDefaultDBConnection(self::$pdo);
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