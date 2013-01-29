<?php
require 'Person.php';
/**
 * @author tocecz
 */
class EntityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Person
     */
    private $entity;
    /*
     * @inheritDoc
     */
    protected function setUp() {
        $this->entity = new \Person("tomas", "cejka");
    }
    /**
     * test serialization
     */
    public function testSerialization() {
        $arr = array($this->entity->getName(), $this->entity->getSurname());
        $serialized = $this->entity->serialize();
        $this->assertEquals($serialized, $arr, "There are different data in arrays");
    }
    /**
     * test unserialization
     */
    public function testUnserialization() {
        $arr = array("John", "Lennon");
        $this->entity->unserialize($arr);
        $this->assertEquals($this->entity->getName(), $arr[0], "Object has not been correctly unserilized");
    }    
}
