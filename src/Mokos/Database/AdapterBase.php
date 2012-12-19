<?php
namespace Mokos\Database;
use Mokos\Database\Column;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author tomascejka
 * @category   Database
 * @package    Database
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * Base class of database table rules for generating entities from database table
 */
abstract class AdapterBase 
{
    /**
     * @var PHP Data Object
     */
    protected $_pdo;
    /**
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo) 
    {
        $this->_pdo = $pdo;
    }
    /**
     * Return array of descriptors of table column
     * @return array Mokos\Database\Column objects
     */
    abstract public function getAllFields($tableName);
    /**
     * Return array of descriptors of database table
     * @return array Mokos\Database\Table objects
     */    
    abstract public function getAllTables();
    /**
     * Return mapped type of column as string 
     * @return data type as string
     */
    abstract public function getType(Column $columnDescriptor);
}
