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
abstract class Entity implements \Serializable 
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
    /**
     * @return int unique identificator of entity
     */
    public final function getId() 
    {
        return $this->id;
    }
    /**
     * Set unique identificator of entity
     * @param int $id
     */
    public final function setId($id) 
    {
        $this->id = $id;
    }
    /**
     * @return int version of entity
     */
    public final function getVersion() 
    {
        return $this->version;
    }
    /**
     * Set version of entity
     * @param int $id
     */
    public final function setVersion($version) 
    {
        $this->version = $version;
    }  
}