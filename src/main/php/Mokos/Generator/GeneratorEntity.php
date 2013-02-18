<?php
namespace Mokos\Generator;
use Mokos\Template\Template;
use Mokos\Generator\GeneratorHelper;
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
 * Generator for domain Entity objects
 */
class GeneratorEntity extends GeneratorBase 
{    
    /**
     * Generate classes...
     * @return void
     */
    public function generate () 
    {
        $methods = GeneratorHelper::getMethods($this->adapter);
        $collections = GeneratorHelper::getCollections($this->adapter);
        
        $tables = GeneratorHelper::getAllTables($this->adapter);
        foreach ($tables as $table) {
            $tableName = $table->getName();
            $template = new Template($this->templatePath);
            $template->set(self::MARK_ANNOTATION, "@Entity");
            $date = new \DateTime();
            $template->set('date', $date->format('Y-m-d H:i:s'));
            $template->set(self::EMPTY_CLASS, "//TODO class implementation");
            $template->set(self::EMPTY_METHOD, "//TODO method implementation");
            $template->set(self::TABLE_NAME_SIMPLE, GeneratorHelper::getTableNameSimple($tableName));
            $template->set(self::DOMAIN_NAME, GeneratorHelper::getClazzName($tableName));
            $template->set(self::DOMAIN_NAME_LOWER, GeneratorHelper::getClazzNameLower($tableName));
            $template->set(self::DESCRIPTION, $table->getDescription());
            if(array_key_exists($tableName, $collections)) {
                $template->set('collections', $collections[$tableName]);
            } else {
                $template->set('collections', "");
            }
            //generate relations
            if(array_key_exists($tableName, $methods)) {
                $lower = GeneratorHelper::getClazzNameLower($methods[$tableName]);
                $formated =str_replace("#", "$", $lower);              
                $template->set(self::RELATIONS_METHODS, $formated);
            } else {
                $template->set(self::RELATIONS_METHODS, "");
            }
            $this->fill($template, $tableName);
            $template->write($this->filePath.DIRECTORY_SEPARATOR.GeneratorHelper::getClazzName($tableName).$this->getType().$this->filePostfix.'.php');            
        }
    }
    /**
     * @param \Mokos\Template\Template $template
     * @param string $tableName name of database table
     */
    protected function fill(Template $template, $tableName) 
    {
        $template->set(self::MARK_ANNOTATION, "@Entity");
        $columns = $this->adapter->getAllFields($tableName);
        $fields = "";
        $methods = "";
        foreach ($columns as $column) {
            $columnName = $column->getFieldName();
            $field = $column->getColumnName();
            $type = $column->getType();
            $fields .="    /**\n";
            $fields .="     * ".$column->getComment()."\n";
            $fields .="     * @var ".$type." ".$columnName.";\n";
            $fields .="     */\n";
            $fields .="    private \$".$columnName.";\n";
            $methods .="   /**\n";
            $methods .="     * @return ".$type." $".$columnName.";\n";
            $methods .="     */\n";                
            $methods .="    public function get".$field."()\n";
            $methods .="    {\n" ;
            $methods .="        return \$this->".$columnName.";\n";
            $methods .="    }\n";
            $methods .="    /**\n";
            $methods .="     *@param ".$type." $".$columnName.";\n";
            $methods .="     */\n";                
            $methods .="    public function set".$field."(\$".$columnName.")\n";
            $methods .="    {\n" ;
            $methods .="        \$this->".$columnName."=\$".$columnName.";\n";
            $methods .="    }\n";            
        }
        $template->set(self::CLAZZ_FIELDS, $fields);
        $template->set(self::CLAZZ_GET_SET_METHODS, $methods);
    }
    /**
     * @return string name suffix
     */
    protected function getType() 
    {
        return "";
    }
}