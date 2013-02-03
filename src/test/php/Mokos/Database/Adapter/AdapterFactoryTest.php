<?php
require_once '/../../UnitTestBase.php';
/**
 * Description of AdapterFactoryTest
 *
 * @author derhaa
 */
class AdapterFactoryTest extends \UnitTestBase 
{
    /**
     * @var \Mokos\Database\Adapter\AdapterFactory
     */
    private $mock;
    /** */
    public function __construct() 
    {
        parent::__construct();
    }
    /*
     * (non-PHPdoc)
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp() 
    {
        $this->mock = new \Mokos\Database\Adapter\AdapterFactory();
    }
    /**
     * Test generate clazz name
     */
    public function testGetAdapter() 
    {
        $adapter = $this->mock->getAdapter($this->configuration);
        $this->assertTrue($adapter instanceof \Mokos\Database\Adapter\AdapterMysql);
    }
}
