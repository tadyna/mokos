<?php
namespace Mokos\Generator;
use Mokos\Database\Adapter\Adapter;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author derhaa 
 * @category   Generator
 * @package    Generator
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * Helper class
 */
class GeneratorHelper {
    /**
     * @var array of \Mokos\Database\Metadata\Table objects
     */    
    private static $foreignKeys;    
    /**
     * @var array of \Mokos\Database\Metadata\Table objects
     */    
    private static $allTables;
    /**
     * @var array of collections, relationship between tables
     */    
    private static $collections;    
    /**
     * @var array of methods
     */    
    private static $methods;
    /**
     * @param \Mokos\Database\Adapter\Adapter $adapter
     * @return array of \Mokos\Database\Metadata\Table objects
     */
    public static function getTableWithPrimaryKey($adapter)
    {
        if(self::$foreignKeys == null) self::$foreignKeys = $adapter->getTablesWithPrimaryKey();
        return self::$foreignKeys;
    }
    /**
     * @param \Mokos\Database\Adapter\Adapter $adapter
     * @return array of \Mokos\Database\Metadata\Table objects
     */
    public static function getAllTables(Adapter $adapter)
    {
        if(self::$allTables === null) self::$allTables = $adapter->getRelations();
        return self::$allTables;
    }
    /**
     * @param \Mokos\Database\Adapter\Adapter $adapter
     * @var array of collections
     */    
    public static function getCollections(Adapter $adapter)
    {        
        if(self::$collections != null) return self::$collections;
        if(self::$foreignKeys == null) self::$foreignKeys = $adapter->getTablesWithPrimaryKey();
        $collections = array();
        foreach ($adapter->getRelations() as $table){
            $columns = $table->getColumns();
            $tableName = $table->getName();
            // if table has no primary key (eg. many2many table)
            if(array_search($tableName, self::$foreignKeys, true) == null) 
            {
                $counter = 0;
                $y = "";
                foreach ($columns as $column) {
                    $columnx = $columns[$counter++];
                    $name = \Mokos\Translator::translate($column->getColumnName());
                    $y .= "\tprivate $".self::getClazzNameLower($name)."s = array();\n";
                    $collections[$columnx->getReferencedTable()] = $y;
                }
            } 
            // if table has primary key (eg. table with one2many relation(s))
            else 
            {
                $y = "";
                foreach ($columns as $column) {
                    $name = \Mokos\Translator::translate($column->getColumnName());
                    $y .= "\tprivate $".self::getClazzNameLower($name)."s = array();\n";
                    $collections[$tableName] = $y;
                }
            }
        } 
        self::$collections = $collections;
        return self::$collections;        
    }
    /**
     * Return associative array with 'method'=>methods 
     * @param \Mokos\Database\Adapter\Adapter $adapter
     * @return array with methods
     */
    public static function getMethods(Adapter $adapter) 
    {
        if(self::$methods != null) return self::$methods;
        if(self::$foreignKeys == null) self::$foreignKeys = $adapter->getTablesWithPrimaryKey();
        $methods = array();
        foreach ($adapter->getRelations() as $table){
            $columns = $table->getColumns();
            $tableName = $table->getName();
            // if table has no primary key (eg. many2many table)
            if(array_search($tableName, self::$foreignKeys, true) == null) 
            {
                $counter = 0;
                $x = "";
                $y = "";
                foreach ($columns as $column) {
                    $columnx = $columns[$counter++];
                    $name = \Mokos\Translator::translate($column->getName());
                    $x .= "\t/*\n";
                    $x .= "\t * Add ".$name." objects to domain object \n";
                    $x .= "\t * @param array ".$name." objects \n";
                    $x .= "\t */\n";
                    $x .= "\tpublic function add_".$name."s(array $".$name."s){}\n";
                    $x .= "\t/*\n";
                    $x .= "\t * Remove ".$name." objects from domain object \n";
                    $x .= "\t * @param array ".$name." objects. If it is null remove all related ".$name." objects \n";
                    $x .= "\t */\n";
                    $x .= "\tpublic function remove_".$name."s(array $".$name."s = null){}\n";                    
                    $methods[$columnx->getReferencedTable()][] = $x;
                }
            } 
            // if table has primary key (eg. table with one2many relation(s))
            else 
            {
                $x = "";
                $y = "";
                foreach ($columns as $column) {
                    $name = \Mokos\Translator::translate($column->getName());
                    $clazz = self::getClazzName($name);
                    $x .= "\t/*\n";
                    $x .= "\t * Add ".$clazz." objects to domain object \n";
                    $x .= "\t * @param array ".$clazz." objects \n";
                    $x .= "\t */\n";
                    $x .= "\tpublic function add_".$name."s(array $".$name."s){}\n";
                    $x .= "\t/*\n";
                    $x .= "\t * Remove ".$clazz." objects to domain object \n";
                    $x .= "\t * @param array ".$clazz." objects. If it is null remove all related ".$clazz." objects \n";
                    $x .= "\t */\n";
                    $x .= "\tpublic function remove_".$name."s(array $".$name."s = null){}\n";  
                    $methods[$tableName] = $x;
                }
            }
        } 
        self::$methods = $methods;
        return self::$methods;
    }
    /**
     * Give table name and upperCase first letter in name,
     * and if table contains '_' removed than and use camel-based naming class
     * @param string $tableName of table
     * @return string modified table name for class
     */
    public static function getClazzName($tableName)
    {
        $name = strtoupper($tableName[0]).substr($tableName,1);
        for($i=0;$i<strlen($name);$i++){
            if($name[$i]=='_'){
                $name = substr($name, 0, $i).strtoupper($name[$i+1]).substr($name, $i+2);
            }
        }
        return $name;
    }
    /**
     * Extract table name from metadata object
     * @return string camelized name of table
     */
    public static function getClazzNameLower($tableName)
    {
          $name = strtolower($tableName);
          for($i=0;$i<strlen($name);$i++){
              if($name[$i]=='_'){
                  $name = substr($name, 0, $i).strtoupper($name[$i+1]).substr($name, $i+2);
              }
          }          
          return $name;
    }
    /**
     * Extract table name from metadata object
     * @return string name of table without underscores
     */
    public static function getTableNameSimple($tableName)
    {
          $name = strtolower($tableName);         
          return str_ireplace("_", " ", $name);
    }
}