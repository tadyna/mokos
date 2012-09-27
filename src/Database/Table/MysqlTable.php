<?php
namespace Mokos\Database\Table;
use Mokos\Database\Table\Base;
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
class MysqlTable extends Base {
    /*
     * Return mysql specific column metadata
     * @return array RowMapper objects
     */
    protected function _getFields($tableName) {
        $rowMappers[] = array();
        foreach ($this->_pdo->query('describe '.$tableName) as $row) {
            $rowMappers[] = new RowMapper (
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
        return $rowMappers;        
    }
    /*
     * Return list of tables metadata via mysql specific query
     * @return array tables' metadata
     */
    protected function _getTables() {
        return $this->_pdo->query('show tables');
    }
    /*
     * Return mapped type of column 
     * @return string data type
     */
    protected function _getTypes(RowMapper $rowMapper) {
        $type = $rowMapper->getType();
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
