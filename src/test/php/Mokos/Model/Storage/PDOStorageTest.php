<?php
require_once '/../../DatabaseTestBase.php';
use Mokos\Model\Storage\PDO\PDOStorage;
use Mokos\Model\Storage\PDO\SqlDescriptor;
/**
 * @author tomascejka
 * @deprecated
 */
class PDOStorageTest extends \DatabaseTestBase 
{
    /**
     * @var string name of database table 
     */
    private static $TABLE_NAME = 'person_in_organization';
    /**
     * @var string filepath for testing resources (datasets)
     */
    private $resources;
    /**
     * @var PDOStorage
     */
    private $testedObject;
    /**
     * Create tested object Mokos\Model\Storage\PDO\PDOStorage
     */
    public function __construct()
    {
        parent::__construct();
        $this->testedObject = new PDOStorage($this->configuration->getConnection());
        $this->resources = $this->pathResources.DIRECTORY_SEPARATOR.'Model'.DIRECTORY_SEPARATOR.'Storage'.DIRECTORY_SEPARATOR;
    }
    /*
     * (non-PHPdoc)
     * @see PHPUnit\Extensions\Database\TestCase::getDataSet
    */
    protected function getDataSet()
    {
        return $this->createFlatXMLDataSet($this->resources.'person-seed.xml');
    }	
    /**
     * Test creating domain object
     */
    public function testCreatePerson()
    {
        $data = array('ID_PERSON'=>3, 'FULLNAME'=>'Nikodim Michal');
        $this->testedObject->insert(new SqlDescriptor(self::$TABLE_NAME, $data));		
        $xml_dataset = $this->createFlatXMLDataSet($this->resources.'person-after-new-person.xml');
        $this->assertDataSetsEqual($xml_dataset, $this->getConnection()->createDataSet());
    }
    /**
     * Test update domain object
     */
    public function testUpdatePerson()
    {
        $data = array('FULLNAME'=>'Karolina Malkova UPD');
        $descriptor = new SqlDescriptor(self::$TABLE_NAME, $data, array('ID_PERSON'=>2));
        $this->testedObject->update($descriptor);

        $xml_dataset = $this->createFlatXMLDataSet($this->resources.'person-after-update-person.xml');
        $this->assertDataSetsEqual($xml_dataset, $this->getConnection()->createDataSet());
    }	
}