<?php
namespace Mokos\Database\Adapter;
use Mokos\Database\Configuration;
use Mokos\Database\Adapter\Adapter;
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
    protected $pdo;
    /**
     * @var string name of database schema
     */
    protected $schemaName;
    /**
     * @param \Mokos\Database\Configuration $configuration
     */
    public function __construct(Configuration $configuration) 
    {
        $this->schemaName = $configuration->getDbName();
        $this->pdo = $configuration->getConnection();
    }
    /**
     * @inheritDoc
     */
    public function getRelations() {
        return array();
    }
}