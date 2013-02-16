<?php
namespace Mokos\Generator;
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
     * Return associative array with 'method'=>methods and 'collection'=>collections
     * @param \Mokos\Database\Adapter\Adapter $adapter
     * @return array with methods and collections
     */
    public static function getMethods(\Mokos\Database\Adapter\Adapter $adapter) 
    {
        $foreignKeys = $adapter->getTablesWithPrimaryKey();
        $methods = array();
        $collections = array();
        //foreach ($this->adapter->getRelations() as $tableName => $columns){
        foreach ($adapter->getRelations() as $table){
            $columns = $table->getColumns();
            $tableName = $table->getName();
            // if table has no primary key (eg. many2many table)
            if(array_search($tableName, $foreignKeys, true) == null) 
            {
                $counter = 0;
                $x = "";
                $y = "";
                foreach ($columns as $column) {
                    $columnx = $columns[$counter++];
                    $x .= "\t/*\n";
                    $x .= "\t * Add ".$column->getColumnName()." objects to domain object \n";
                    $x .= "\t * @param array ".$column->getColumnName()." objects \n";
                    $x .= "\t */\n";
                    $x .= "\tpublic function add_".$column->getColumnName()."s(array $".$column->getColumnName()."s){}\n";
                    $x .= "\t/*\n";
                    $x .= "\t * Remove ".$column->getColumnName()." objects from domain object \n";
                    $x .= "\t * @param array ".$column->getColumnName()." objects. If it is null remove all related ".$column->getColumnName()." objects \n";
                    $x .= "\t */\n";
                    $x .= "\tpublic function remove_".$column->getColumnName()."s(array $".$column->getColumnName()."s = null){}\n";                    
                    $methods[$columnx->getReferencedTable()][] = $x;
                    $y .= "\tprivate $".self::getClazzNameLower($column->getColumnName())."s = array();\n";
                    $collections[$columnx->getReferencedTable()] = $y;
                }
            } 
            // if table has primary key (eg. table with one2many relation(s))
            else 
            {
                $x = "";
                $y = "";
                foreach ($columns as $column) {
                    $x .= "\t/*\n";
                    $x .= "\t * Add ".$column->getColumnName()." objects to domain object \n";
                    $x .= "\t * @param array ".$column->getColumnName()." objects \n";
                    $x .= "\t */\n";
                    $x .= "\tpublic function add_".$column->getColumnName()."s(array $".$column->getColumnName()."s){}\n";
                    $x .= "\t/*\n";
                    $x .= "\t * Remove ".$column->getColumnName()." objects to domain object \n";
                    $x .= "\t * @param array ".$column->getColumnName()." objects. If it is null remove all related ".$column->getColumnName()." objects \n";
                    $x .= "\t */\n";
                    $x .= "\tpublic function remove_".$column->getColumnName()."s(array $".$column->getColumnName()."s = null){}\n";  
                    $methods[$tableName] = $x;
                    $y .= "\tprivate $".self::getClazzNameLower($column->getColumnName())."s = array();\n";
                    $collections[$tableName] = $y;
                }
            }
        } 
        $retval = array(
            'methods'=>$methods,
            'collections'=>$collections
        );
        return $retval;
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