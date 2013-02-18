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
 * Generator for Repository objects
 */
class GeneratorRepository extends GeneratorBase 
{
    /**
     * Generate classes...
     * @return void
     */
    public function generate () 
    {
        $methods = GeneratorHelper::getMethods($this->adapter);
        $tables = $this->adapter->getAllTables();
        foreach ($tables as $table) {
            $tableName = $table->getName();
            $template = new Template($this->templatePath);
            $template->set(self::MARK_ANNOTATION, "@Repository");
            $date = new \DateTime();
            $template->set('date', $date->format('Y-m-d H:i:s'));
            $template->set(self::EMPTY_CLASS, "//TODO class implementation");
            $template->set(self::EMPTY_METHOD, "//TODO method implementation");
            $template->set(self::TABLE_NAME_SIMPLE, GeneratorHelper::getTableNameSimple($tableName));
            $template->set(self::DOMAIN_NAME, GeneratorHelper::getClazzName($tableName));
            $template->set(self::DOMAIN_NAME_LOWER, GeneratorHelper::getClazzNameLower($tableName));
            $template->set(self::DOMAIN_PRIMARY_KEY, $table->getPrimaryKeyColumnName());
            $template->set(self::DESCRIPTION, $table->getDescription());
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
        //do nothing ...
    }
    /**
     * @return string name suffix
     */
    protected function getType() 
    {
        return "Repository";
    }
}