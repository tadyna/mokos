<?php
require_once '/../DatabaseTestBase.php';
/**
 * Description of db_Database
 *
 * @author derhaa
 */
class DatabaseTest extends \DatabaseTestBase 
{
    /**
     * @var Mokos\Database\Database
     */
    private $object;
    /**
     * Create test object
     */
    public function __construct()
    {
        parent::__construct();
        $this->object = null;
    }    
    /*
     * (non-PHPdoc)
     * @see PHPUnit\Extensions\Database\TestCase::getDataSet
     */
    protected function getDataSet() {
        return $this->createFlatXMLDataSet($this->pathResources.'databaseTest.xml');
    }    
}
