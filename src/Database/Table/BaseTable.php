<?php
namespace Mokos\Database\Table;
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
abstract class Base {
    /**
     * @var string path to template file
     */
    private $_templatePath;
    /**
     * @var string path to directory where file will be generated 
     */
    private $_filePath;
    /**
     *
     * @var PHP Data Object
     */
    private $_pdo;
    /**
     * 
     * @param type $templatePath
     * @param type $filePath
     */
    public function __construct($templatePath, $filePath, \PDO $pdo) 
    {
        $this->_templatePath = $templatePath;
        $this->_filePath = $filePath;
        $this->_pdo = $pdo;
    }
    /**
     * Extract column name from metadata object
     * @return string name of colunm
     */
    protected final function _getFieldRawName($column)
    {         
          return $column['field'];
    }    
    /**
     * Extract column name from metadata object
     * @return string name of colunm
     */
    protected final function _getFieldName($column)
    {
          $columnName = strtolower($column['field']);
          for($i=0;$i<strlen($columnName);$i++){
              if($columnName[$i]=='_'){
                  $columnName = substr($columnName, 0, $i).strtoupper($columnName[$i+1]).substr($columnName, $i+2);
              }
          }          
          return $columnName;
    }
    /**
     * Give table name and upperCase first letter in name,
     * and if table contains '_' removed than and use camel-based naming class
     * @return string name of table for class
     */
    protected final function _getClazzName($tableName)
    {
        $tableName = strtoupper($tableName[0]).substr($tableName,1);
        for($i=0;$i<strlen($tableName);$i++){
            if($tableName[$i]=='_'){
                $tableName = substr($tableName, 0, $i).strtoupper($tableName[$i+1]).substr($tableName, $i+2);
            }
        }
        return $tableName;
    }
    /**
     * Do the same as getClazzName, but there is used name of column to generate name of column
     */
    protected final function _getColumnName($column)
    {
        $retval = $this->_getFieldName($column);
        $retval = strtoupper($retval[0]).substr($retval,1);
        return $retval;
    }     
    /**
     * @abstract
     */
    protected abstract function _getTables();
    /**
     * @abstract
     */    
    protected abstract function _getFields($tableName);
    /**
     * @abstract
     */    
    protected abstract function _getTypes(RowMapper $rowMapper);
}