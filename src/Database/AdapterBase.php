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
 * @author tomascejka
 * @category   Database
 * @package    Database
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * Base class of database table rules for generating entities from database table
 */
abstract class AdapterBase {
    /**
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

    abstract public function getAllFields($tableName);
    abstract public function getAllTables();
    abstract public function getType(ColumnDescriptor $columnDescriptor);
}
