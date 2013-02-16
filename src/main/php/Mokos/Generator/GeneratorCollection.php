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
 * Generator for Service objects
 */
class GeneratorCollection extends GeneratorBase 
{
    /**
     * Generate classes...
     * @return void
     */
    public function generate () 
    {
        $tablesF = $this->adapter->getTablesWithPrimaryKey();
        $tables = $this->adapter->getAllTables();
        foreach ($tables as $table) {
            $tableName = $table->getName();
            if(!array_key_exists($tableName, $tablesF)) {
                continue;
            }
            $template = new Template($this->templatePath);
            $date = new \DateTime();
            $template->set('date', $date->format('Y-m-d H:i:s'));
            $template->set(self::EMPTY_CLASS, "//TODO class implementation");
            $template->set(self::EMPTY_METHOD, "//TODO method implementation");
            $template->set(self::TABLE_NAME_SIMPLE, GeneratorHelper::getTableNameSimple($tableName));
            $template->set(self::DOMAIN_NAME, GeneratorHelper::getClazzName($tableName));
            $template->set(self::DOMAIN_NAME_LOWER, GeneratorHelper::getClazzNameLower($tableName));
            $template->set(self::DESCRIPTION, $table->getDescription());
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
        // do nothing ... 
    }
    /**
     * @return string name suffix
     */
    protected function getType() 
    {
        return "Collection";
    }
}