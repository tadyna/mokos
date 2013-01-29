<?php
use Mokos\Model\Entity;
/**
 *
 * @date: 2013-01-30 15:54
 * @version: ${version}
 *      
 * Table with persons in organization     
 */
class PersonInOrganization extends Entity
{
        /**
     * 
     * @var int idPerson;
     */
    private $idPerson;
    /**
     * 
     * @var varchar fullname;
     */
    private $fullname;

       /**
     * @return int $idPerson;
     */
    public function getIdPerson()
    {
        return $this->idPerson;
    }
    /**
     *@param int $idPerson;
     */
    public function setIdPerson($idPerson)
    {
        $this->idPerson=$idPerson;
    }
   /**
     * @return varchar $fullname;
     */
    public function getFullname()
    {
        return $this->fullname;
    }
    /**
     *@param varchar $fullname;
     */
    public function setFullname($fullname)
    {
        $this->fullname=$fullname;
    }

    /**
     * @return array represetantion of entity
     * @throw EntityException if serialization fails
     */
    protected final function serialize() 
    {
        $retval = array();
        return $retval;
    }
    /**
     * It allows deserializovat entity from various sources
     * @param mixed $serialized 
     * @throw EntityException if deserialization fails
     */
    protected final function unserialize($serialized) 
    {
        if(is_array($serialized)) {
            //do something
        } else if (is_object($serialized)) {
            // do something
        } else {
            throw new Exception('PersonInOrganization object cannot be deserialized', null, null);
        }
    }
}