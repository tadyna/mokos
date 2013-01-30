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
     * @var Mokos\Database\Adapter
     */
    private $object;
    /*
     * (non-PHPdoc)
     * @see PHPUnit\Extensions\Database\TestCase::getDataSet
     */
    protected function getDataSet() {
        return $this->createFlatXMLDataSet($this->pathResources.'databaseTest.xml');
    }    
}
