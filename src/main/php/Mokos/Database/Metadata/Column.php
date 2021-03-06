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
 * Descriptor of table column
 */
class Column 
{
    /**
     * @var string 
     */
    private $name;
    /**
     * @var string 
     */
    private $type;
    /**
     * @var bool 
     */
    private $nullable;
    /**
     * @var string 
     */    
    private $key;
    /**
     * @var bool 
     */
    private $unique;
    /**
     * @var bool 
     */
    private $primary;
    /**
     * @var int 
     */
    private $maxLength;
    /**
     * @var string 
     */
    private $extra;
    /**
     * @var mixed 
     */
    private $default;
    /**
     * @var string 
     */
    private $comment;
    /**
     * @var string 
     */
    private $refTab;
    /**
     * @var string 
     */
    private $refCol;    
    /**
     * Descriptor of table column
     * @param string $columName
     * @param string $type
     * @param bool $nullable
     * @param string $key
     * @param bool $unique
     * @param bool $primary
     * @param int $maxLength
     * @param mixed $extra
     * @param mixed $default
     * @param string $comment
     * @param string $referencedTable foreign key table
     * @param string $referencedColumn foreign key column
     */
    public function __construct(
            $columnName,
            $type, 
            $nullable, 
            $key, 
            $unique, 
            $primary, 
            $maxLength, 
            $extra, 
            $default, 
            $comment, 
            $referencedTable,
            $referencedColumn) 
    {
        $this->name = $columnName;
        $this->type = $type;
        $this->nullable = $nullable;
        $this->key = $key;
        $this->unique = $unique;
        $this->primary = $primary;
        $this->maxLength = $maxLength;
        $this->extra = $extra;
        $this->default = $default;
        $this->comment = $comment;
        $this->refTab = $referencedTable;
        $this->refCol = $referencedColumn;
    }
    public final function getName()
    {
        return $this->name;
    }
    /**
     * Extract column name from metadata object
     * @return string camelized name of column
     */
    public final function getFieldName()
    {
          $columnName = strtolower($this->name);
          for($i=0;$i<strlen($columnName);$i++){
              if($columnName[$i]=='_'){
                  $columnName = substr($columnName, 0, $i).strtoupper($columnName[$i+1]).substr($columnName, $i+2);
              }
          }          
          return $columnName;
    }
    /**
     * Return name of column
     * @return string
     */
    public function getColumnName() 
    {
        $retval = $this->getFieldName();
        $retval = strtoupper($retval[0]).substr($retval,1);
        return $retval;
    }
    /**
     * Return data type of column
     * @return string
     */
    public function getType() 
    {
        return $this->type;
    }
    /**
     * Return if column is nullable
     * @return bool
     */
    public function isNullable() 
    {
        return $this->nullable;
    }
    /**
     * Return key of column, eg. PRI, UNI, MUL see mysql manual
     * @return string
     */
    public function getKey() 
    {
        return $this->key;
    }
    /**
     * Return if column is unique
     * @return bool
     */
    public function isUnique() 
    {
        return $this->unique;
    }
    /**
     * Return if column is primary
     * @return bool
     */
    public function isPrimary() 
    {
        return $this->primary;
    }
    /**
     * Return max length of value
     * @return int
     */
    public function getMaxLength() 
    {
        return $this->maxLength;
    }
    /**
     * Return specified value, eg. auto_increment
     * @return mixed|string
     */
    public function getExtra() 
    {
        return $this->extra;
    }
    /**
     * Return default value of column
     * @return mixed
     */
    public function getDefault() 
    {
        return $this->default;
    }
    /**
     * Return comment of column
     * @return string
     */
    public function getComment() 
    {
        return $this->comment;
    }
    /**
     * @return string name of referenced table
     */
    public function getReferencedTable()
    {
        return $this->refTab;
    }
    /**
     * @return string name of referenced column
     */    
    public function getReferencedColumn()
    {
        return $this->refCol;
    }    
}