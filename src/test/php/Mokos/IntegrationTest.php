<?php
require_once 'Configuration.php';
require_once 'TruncateDatabaseOperation.php';
/**
 * Basic interface for database/integration test subclass
 * @author derhaa
 */
abstract class IntegrationTest extends PHPUnit_Extensions_Database_TestCase
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
     * @var string name of this class
     */
    private $clazzname;    
    /**
     * Construct PDO object and init database settings
     */
    public function __construct() 
    {
        $this->pathTestDir = '..'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR;
        $this->pathResources = $this->pathTestDir.'Mokos'.DIRECTORY_SEPARATOR;
        $this->configuration = new Configuration();
        $clazz = new \ReflectionClass($this);
        $this->clazzname = $clazz->getName();  
        
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
    /*
     * Get name of directory where test is located and generated path to xml resource
     */
    protected function getDataSet()
    {
        $dir = $this->getDirectoryName();
        if($dir === null || $dir === "" || !file_exists($dir)) {
            throw new Exception ("Directory of test class not found");
        }
        $filePath = str_ireplace("\\mokos\\src\\test\\php", "\\mokos\\src\\test\\resources", $dir).DIRECTORY_SEPARATOR.$this->clazzname.'.xml';
        if(!file_exists($filePath)) {
            throw new Exception($this->clazzname . " has not data resource '".$this->clazzname.".xml' defined. There is must exist file ".$filePath);
        }
        return $this->createFlatXMLDataSet($filePath);
    }
    /**
     * This resolves problem with truncate tables with foreign keys before tests
     * @return \PHPUnit_Extensions_Database_Operation_Composite
     */
    protected function getSetUpOperation()
    {
        //return $this->getOperations()->CLEAN_INSERT();
        return new \PHPUnit_Extensions_Database_Operation_Composite(array(
            new TruncateDatabaseOperation(),
            \PHPUnit_Extensions_Database_Operation_Factory::INSERT()
        ));        
    }
    /**
     * Must return __DIR__ directive in each subclass!
     * @return full filepath of file
     */
    abstract function getDirectoryName();
}
