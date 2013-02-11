<?php
namespace Mokos\Database\Adapter;
use Mokos\Database\Adapter\AdapterBase;
use Mokos\Database\Metadata\Column;
use Mokos\Database\Metadata\Table;
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
 * Adapter database rules for Mysql vendor
 */
class AdapterMysql extends AdapterBase 
{
    /**
     * Return mysql specific column metadata
     * @return array ColumnDescriptor objects
     */
    public function getAllFields($tableName) 
    {
        $descriptors = array();
        $query = "select * from information_schema.columns where table_name='".$tableName."'";
        foreach ($this->pdo->query($query) as $row) {
            $descriptors[$row['COLUMN_NAME']] = new Column (
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
    /**
     * Return list of tables metadata via mysql specific query. Does not return tables
     * which represent many2many relation.
     * @return array Table descriptor
     */
    public function getAllTables() 
    {
        $query="
        select t.table_name as TABLE_NAME, t.table_comment as TABLE_COMMENT, c.column_name, c.column_key 
        from information_schema.tables as t, information_schema.columns as c
        where
            t.table_schema='".$this->schemaName."'
            and c.table_schema='".$this->schemaName."' 
            and t.table_name=c.table_name
            and c.column_key is not null 
            and c.column_key='PRI';";        
    	//$query = "select * from information_schema.tables t where t.table_schema='".$this->schemaName."'";//this query does not filter many2many tables
    	$descriptors = array();
    	$result = $this->pdo->query($query);
        foreach($result as $table){
            $descriptors[] = new Table($table['TABLE_NAME'], $table['TABLE_COMMENT'], null); 
        }
        return $descriptors;
    }
    /**
     * Return mapped type of column 
     * @return string data type
     */
    public function getType(Column $columnDescriptor) 
    {
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
    /**
     * @inheritDoc
     */
    public function getTablesWithPrimaryKey()
    {
        $query = "select c.table_name from information_schema.columns c where c.table_schema='".$this->schemaName."' and column_key='PRI'";
        $result = $this->pdo->query($query);
        $tables = array();
        foreach ($result as $record) {
            $tables[$record[0]] = $record[0];
        }
        return $tables;
    }
    /**
     * @inheritDoc
     */    
    public function getRelations()
    {
        $tables = array();
        $result = $this->pdo->query("select u.table_name, u.column_name, u.referenced_table_name, u.referenced_column_name from information_schema.key_column_usage u
                    where u.table_schema='".$this->schemaName."'
                    and u.referenced_table_name is not null");  
        foreach ($result as $record) {
            $name = $record[0];
            $column = $record[1];//name of "filterColumn", eg. ByPersonId
            $ref = $record[2];//if many2many need referenced table name
            $refCol = $record[3];
//            $rels[] = new \Relationship( new Table($name, null, array($column)), $column, new Table($refTable, null, array($refCol)), $refCol);
            $tableName = $name;//array_key_exists($name, $foreignKeys) ? $name : $ref;
            if(array_key_exists($tableName, $tables)) {
                $tables[$tableName]->addColumn($refCol);
            } else {
                $tables[$tableName] = new Table($tableName, null, array($refCol));
            }
        }
        return $tables;
    }
}