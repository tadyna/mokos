<?php
namespace Mokos\Generator;
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
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * class description here ...
 */
class ColumnMapper {

    private $field;
    private $type;
    private $nullable;
    private $key;
    private $unique;
    private $primary;
    
    public function __construct($field, $type, $nullable, $key, $unique, $primary) {
        $this->field = $field;
        $this->type = $type;
        $this->nullable = $nullable;
        $this->key = $key;
        $this->unique = $unique;
        $this->primary = $primary;
                
    }
    /**
     * Extract column name from metadata object
     * @return string name of colunm
     */
    public final function getFieldName()
    {
          $columnName = strtolower($this->field);
          for($i=0;$i<strlen($columnName);$i++){
              if($columnName[$i]=='_'){
                  $columnName = substr($columnName, 0, $i).strtoupper($columnName[$i+1]).substr($columnName, $i+2);
              }
          }          
          return $columnName;
    }
    
    public function getField() {
        return $this->field;
    }

    public function getType() {
        return $this->type;
    }

    public function isNullable() {
        return $this->nullable;
    }

    public function getKey() {
        return $this->key;
    }

    public function isUnique() {
        return $this->unique;
    }

    public function isPrimary() {
        return $this->primary;
    }
}