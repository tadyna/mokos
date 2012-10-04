<?php
namespace Mokos\Database\Table;
use Mokos\Database\ColumnDescriptor;
use Mokos\Database\Table\AdapterBase;
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
 * @subpackage Table
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * Adapter database rules for Mysql vendor
 */
class AdapterMysql extends AdapterBase {
    /*
     * Return mysql specific column metadata
     * @return array ColumnDescriptor objects
     */
    public function getAllFields($tableName) {
        $descriptors = array();
        $query = "select from information_schema.columns where table_schema='".$tableName."'";
        foreach ($this->_pdo->query($query) as $row) {
            $descriptors[] = new ColumnDescriptor (
                $row['COLUMN_NAME'],
                $row['DATA_TYPE'],
                ($row['IS_NULLABLE'] === 'YES'),
                $row['COLUMN_KEY'],
                ($row['COLUMN_KEY'] === 'UNI'),
                ($row['COLUMN_KEY'] === 'PRI'),
                $row['CHARACTER_MAXIMUM_LENGTH'],
                $row['EXTRA'],
                $row['COLUMN_DEFAULT'],
                $row['COLUMN_COMMENT']
            );
        }
        return $descriptors;        
    }
    /*
     * Return list of tables metadata via mysql specific query
     * @return array tables' metadata
     */
    public function getAllTables() {
        return $this->_pdo->query('show tables');
    }
    /*
     * Return mapped type of column 
     * @return string data type
     */
    public function getType(ColumnDescriptor $columnDescriptor) {
        $type = $columnDescriptor->getType();
        switch ($type) {
            case "varchar":
            case "char":
                $type = "string"; break;
            case "int":
            case "smallint":
            case "tinyint":
            case "mediumint":
            case "bigint":
                $type = "integer"; break;
        }
        return $type;
    }
}