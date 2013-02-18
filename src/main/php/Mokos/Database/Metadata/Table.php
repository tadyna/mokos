<?php
namespace Mokos\Database\Metadata;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author derhaa
 * @category   Database
 * @package    Metadata
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 *
 * Descriptor of table
 */
class Table 
{
    /**
     * @var string table name
     */
    private $name;
    /**
     * @var string table description
     */
    private $description;
    /**
     * @var string name of private key column
     */
    private $privateKey;    
    /**
     *
     * @var array Mokos\Database\Metadata\Column objects
     */
    private $columns;
    /**
     * Descriptor of database table
     */
    public function __construct($tableName, $description, $privateColumnName, $columns = null) 
    {
        $this->name = $tableName;
        $this->description = $description;
        $this->privateKey = $privateColumnName;
        $this->columns = $columns;
    }
    /**
     * Return description of database table
     * @return string
     */
    public function getDescription() 
    {    
        return $this->description;
    }
    /**
     * Return name of database table
     * @return string
     */
    public function getName() 
    {
        return $this->name;
    }
    /**
     * Return name of database table
     * @return string
     */
    public function getPrimaryKeyColumnName() 
    {
        return $this->privateKey;
    }    
    /**
     * @param Column $column
     */
    public function addColumn(Column $column)
    {
        array_push($this->columns, $column);
    }
    /**
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }
}