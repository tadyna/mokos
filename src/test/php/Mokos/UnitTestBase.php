<?php
require_once 'ConfigurationTest.php';
/**
 * Basic interface for database/integration test subclass
 * @author tomascejka
 */
abstract class UnitTestBase extends \PHPUnit_Framework_TestCase 
{
    /**
     * @var string filepath to test directory
     */
    protected $pathTestDir;    
    /**
     * @var string filepath to resource directory 
     */
    protected $pathResources;
    /**
     * @var string filepath to template directory 
     */    
    protected $pathTemplateDir;
    /**
     * @var string filepath to temp directory 
     */    
    protected $pathTemporaryDir;  
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
        var_dump(__DIR__);
        var_dump($this->pathTestDir);
        $this->pathResources = $this->pathTestDir.'Mokos'.DIRECTORY_SEPARATOR;
        $this->pathTemplateDir = $this->pathTestDir.'templates'.DIRECTORY_SEPARATOR;
        //$this->pathTemplateDir = '..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.'\main\resources\templates'.DIRECTORY_SEPARATOR;
        $this->pathTemporaryDir = $this->pathTestDir.DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
        $this->configuration = new ConfigurationTest();
    }
}