<?php
namespace Mokos\Database;
use Mokos\Database\Adapter;
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
abstract class AdapterBase implements Adapter
{
    /**
     * @var PHP Data Object
     */
    protected $_pdo;
    /**
     * @var string name of database schema
     */
    protected $schemaName;
    /**
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo, $schemaName) 
    {
        $this->_pdo = $pdo;
        $this->schemaName = $schemaName;
    }
}
