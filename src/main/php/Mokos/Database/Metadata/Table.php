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
     *
     * @var array Mokos\Database\Metadata\Column objects
     */
    private $columns;
    /**
     * Descriptor of database table
     */
    public function __construct($tableName, $description, $columns = null) 
    {
        $this->name = $tableName;
        $this->description = $description;
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
     * @param string name of column
     */
    public function addColumn($column)
    {
        array_push($this->columns, $column);
    }
    /*  */
    public function getColumns()
    {
        return $this->columns;
    }
}