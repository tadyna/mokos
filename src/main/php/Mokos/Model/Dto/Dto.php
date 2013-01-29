<?php
namespace Mokos\Model\Dto;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author tocecz
 * @category   Transfer
 * @package    Dto
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * Base class of data transfer object
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