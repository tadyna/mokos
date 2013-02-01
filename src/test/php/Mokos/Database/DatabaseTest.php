<?php
require_once '/../IntegrationTest.php';
/**
 * Description of db_Database
 *
 * @author derhaa
 */
class DatabaseTest extends \IntegrationTest 
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
     * @see DatabaseTestBase::getDirectoryName()
     */
    public function getDirectoryName()
    {
        return __DIR__;
    }
}