<?php
namespace Mokos\Generator;
use Mokos\Generator\Generator;
use Mokos\Database\Adapter\AdapterBase;
use Mokos\Template\Template;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author tomascejka
 * @category   Generator
 * @package    Generator
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * Base class for generation of various classes
 */
abstract class GeneratorBase implements Generator 
{
    const APP_VERSION = 'version';
    const MARK_ANNOTATION = 'mark_annotation';
    const TABLE_NAME_SIMPLE = 'table_name_simple';
    const DOMAIN_NAME = 'domain_name';
    const DOMAIN_NAME_LOWER = 'domain_name_lower';
    const DOMAIN_DESCRIPTION = 'domain_description';
    const CLAZZ_FIELDS = 'clazz_fields';
    const CLAZZ_GET_SET_METHODS = 'clazz_get_set_methods';
    const CLAZZ_SERIALIZATION = 'clazz_serialize';
    const CLAZZ_DESERIALIZATION = 'clazz_deserialize';
    const EMPTY_CLASS = "empty_class";
    const EMPTY_METHOD = "empty_method";
    /**
     * @var \Mokos\Database\Adapter\Adapter
     */
    protected $adapter;
    /**
     * @var string path to template file
     */
    protected $templatePath;
    /**
     * @var string path to directory where file will be generated 
     */
    protected $filePath;
    /**
     * @var string name of postfix for filename
     */
    protected $filePostfix;    
    /**
     * @param string $templatePath
     * @param string $filePath
     * @param string $filePostfix
     * @param \Mokos\Database\AdapterBase $adapter
     */
    public function __construct($templatePath, $filePath, $filePostfix, AdapterBase $adapter) 
    {
        $this->filePath = $filePath;
        $this->templatePath = $templatePath;
        $this->adapter = $adapter;
        $this->filePostfix = $filePostfix;
    }
    /**
     * Generate classes...
     * @return void
     */
    public function generate () 
    {
        $tables = $this->adapter->getAllTables();
        foreach ($tables as $table) {
            $tableName = $table->getName();
            $template = new Template($this->templatePath);
            $date = new \DateTime();
            $template->set('date', $date->format('Y-m-d H:i:s'));
            $template->set(self::EMPTY_CLASS, "//TODO class implementation");
            $template->set(self::EMPTY_METHOD, "//TODO method implementation");
            $template->set(self::TABLE_NAME_SIMPLE, $this->getTableNameSimple($tableName));
            $template->set(self::DOMAIN_NAME, $this->getClazzName($tableName));
            $template->set(self::DOMAIN_NAME_LOWER, $this->getClazzNameLower($tableName));            
            $this->fill($template, $tableName, $table->getDescription());
            $template->write($this->filePath.DIRECTORY_SEPARATOR.$this->getClazzName($tableName).$this->getType().$this->filePostfix.'.php');
        }
    }
    /**
     * Give table name and upperCase first letter in name,
     * and if table contains '_' removed than and use camel-based naming class
     * @return string modified table name for class
     */
    public final function getClazzName($tableName)
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
    public final function getClazzNameLower($tableName)
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
    public final function getTableNameSimple($tableName)
    {
          $name = strtolower($tableName);         
          return str_ireplace("_", " ", $name);
    }     
    /**
     * Fill template by specific variables by given generator implementation
     * @return void
     */
    protected abstract function fill(Template $template, $tableName, $tableDescription);
    /**
     * Returned name is used in filename
     * @return string of generated entity, eg. Dao, Mapper, Repository
     */
    protected abstract function getType();
}