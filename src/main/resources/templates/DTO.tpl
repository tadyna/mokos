<?php
namespace Mokos\Model\Dto;
/**
 * @date: ${date}
 * @version: ${version}
 *      
 */
abstract class Dto implements \Serializable
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