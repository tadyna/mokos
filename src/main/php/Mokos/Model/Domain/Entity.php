<?php
namespace Mokos\Model\Domain;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author     derhaa
 * @category   Entity
 * @package    Domain
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * This is central domain model class represents as Entity
 */
abstract class Entity implements \Serializable {
    /** 
     * Unique id of object
     * @var int 
     */
    private $id;
    /**
     * Object can be versioned
     * @var int
     */
    private $version;
    /**
     * @return int unique identificator of entity
     */
    public final function getId() {
        return $this->id;
    }
    /**
     * Set unique identificator of entity
     * @param int $id
     */
    public final function setId($id) {
        $this->id = $id;
    }
    /**
     * @return int version of entity
     */
    public final function getVersion() {
        return $this->version;
    }
    /**
     * Set version of entity
     * @param int $id
     */
    public final function setVersion($version) {
        $this->version = $version;
    }
    /*
     * String representation of entity object
     * @throw EntityException if serialization fails
     * @return string representation of entity object
     */
    public final function serialize() {
        try {
            return $this->writeObject();
        } catch (\Exception $e) {
            throw new EntityException('Entity cannot be serialized', null, $e);
        }
    }
    /*
     * It allows deserializovat (construct) entity from string
     * @param string $serialized string representation of the object. 
     * @throw EntityException if deserialization fails
     */
    public final function unserialize($serialized) {
        try {
            $this->readObject($serialized);
        } catch (\Exception $e) {
            throw new EntityException('Entity cannot be deserialized', null, $e);
        }
    }
    /**
     * @abstract
     * Serialize object to string represetation
     * @throw EntityException if serialization fails
     * @return string serializied entity object
     */
    abstract protected function writeObject();
    /**
     * @abstract
     * Construct object from string representation
     * @param string $serialized
     */
    abstract protected function readObject($serialized);    
}