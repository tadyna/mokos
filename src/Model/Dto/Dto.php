<?php
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author tocecz <dev.cejkatomas@gmail.com>
 * @category   Transfer
 * @package    Model
 * @subpackage Dao
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * class description here ...
 */
abstract class Dto implements Serializable
{
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
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getVersion() {
        return $this->version;
    }

    public function setVersion($version) {
        $this->version = $version;
    }
    /*
     * 
     */
    public function serialize() {
        
    }
    /*
     * 
     */
    public function unserialize($serialized) {
        
    }    
}