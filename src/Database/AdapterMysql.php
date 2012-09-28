<?php
namespace Mokos\Database\Table;
use Mokos\Database\ColumnMapper;
use Mokos\Database\Table\AdapterBase;
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
class AdapterMysql extends AdapterBase {
    /*
     * Return mysql specific column metadata
     * @return array ColumnMapper objects
     */
    protected function _getAllFields($tableName) {
        $mappers[] = array();
        foreach ($this->_pdo->query('describe '.$tableName) as $row) {
            $mappers[] = new ColumnMapper (
                $row['Field'],
                $row['Type'],
                (array_key_exists('NULL', $row)) ? $row['NULL'] === 'YES' ? true : false : false,
                $row['Key'],
                ($row['Key'] === 'UNI') ? true : false,
                ($row['Key'] === 'PRI') ? true : false
                //'default'  =>$row['Default'],
                //'extra'    =>$row['Extra'],
            );
        }
        return $mappers;        
    }
    /*
     * Return list of tables metadata via mysql specific query
     * @return array tables' metadata
     */
    protected function _getAllTables() {
        return $this->_pdo->query('show tables');
    }
    /*
     * Return mapped type of column 
     * @return string data type
     */
    protected function _getType(ColumnDescriptor $columnMapper) {
        $type = $columnMapper->getType();
        if(strpos($type, "(")) {
            $arr = explode("(", $type);
            $type = $arr[0];
        }
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