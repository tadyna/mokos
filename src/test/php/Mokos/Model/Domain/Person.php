<?php
use Mokos\Model\Domain\Entity;
/**
 * @author tomascejka
 */
class Person extends Entity 
{
    private $name;
    private $surname;
    
    public function __construct($name, $surname) {
        $this->name = $name;
        $this->surname = $surname;
    }
    
    public function serialize() {
        $arr = array($this->name, $this->surname);
        return $arr;
    }
    
    public function unserialize($unserialized) {
        $this->name = $unserialized[0];
        $this->surname = $unserialized[1];
    }
    
    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }    
}