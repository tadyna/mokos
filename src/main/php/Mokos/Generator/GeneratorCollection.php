<?php
namespace Mokos\Generator;
use Mokos\Template\Template;
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
        $tables = $this->adapter->getAllTables();
        foreach ($tables as $table) {
            /*
             *  //TODO check if table is 'aggregateable' and get parent tablename ...
             */
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
     * @param \Mokos\Template\Template $template
     * @param string $tableName name of database table
     */
    protected function fill(Template $template, $tableName) 
    {
        $template->set(self::DESCRIPTION, "Aggregate root collection for ".$this->getClazzName($tableName)." entity");
        $columns = $this->adapter->getAllFields($tableName);
        foreach ($columns as $column) {
            /* @var $column \Mokos\Database\Metadata\Column */
            if($column->isPrimary()) {
                $template->set(self::DOMAIN_GET_PRIMARY_METHOD, 'get'.$column->getColumnName().'()');     
                break;
            }           
        }
    }
    /**
     * @return string name suffix
     */
    protected function getType() 
    {
        return "Collection";
    }
}