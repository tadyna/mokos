<?php
namespace Mokos\Database;
use Mokos\Database\ColumnDescriptor;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author derhaa <dev.cejkatomas@gmail.com>
 * @category   Database
 * @package    Database
 * @subpackage Table
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * class description here ...
 */
abstract class AdapterBase {
    /**
     *
     * @var PHP Data Object
     */
    private $_pdo;
    /**
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo) 
    {
        $this->_pdo = $pdo;
    }
    public final function getAllTables () {
        return $this->_getAllTables();
    }
    public final function getAllFields ($tableName) {
        return $this->_getAllFields($tableName);
    }
    public final function getType (ColumnDescriptor $mapper) {
        return $this->_getType($mapper);
    }    
    /**
     * @abstract
     */
    protected abstract function _getAllTables();   
    /**
     * @abstract
     */    
    protected abstract function _getAllFields($tableName);
    /**
     * @abstract
     */    
    protected abstract function _getType(ColumnDescriptor $rowMapper);
}