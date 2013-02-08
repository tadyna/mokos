<?php
namespace Mokos\Database\Adapter;
use Mokos\Database\Adapter\AdapterBase;
use Mokos\Database\Metadata\Column;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author derhaa
 * @category   Database
 * @package    Database
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * Adapter database rules for Mssql vendor
 */
class AdapterMssql extends AdapterBase 
{
    /**
     * Return mysql specific column metadata
     * @return array ColumnDescriptor objects
     */
    public function getAllFields($tableName) 
    {
        $descriptors = array();
        return $descriptors;        
    }
    /**
     * Return list of tables metadata via Mssql specific query
     * @return array Table descriptor
     */
    public function getAllTables() 
    {
    	$descriptors = array();
        return $descriptors;
    }
    /**
     * Return mapped type of column 
     * @return string data type
     */
    public function getType(Column $columnDescriptor) 
    {
        $type = $columnDescriptor->getType();
        return $type;
    }
    /**
     * @inheritDoc
     */
    public function getTablesWithPrimaryKey() {
        return array();
    }
}