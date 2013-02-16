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
class GeneratorDomain2Dto extends GeneratorBase 
{    
    /**
     * Generate classes...
     * @return void
     */
    public function generate () 
    {
        $template = new Template($this->templatePath);
        $date = new \DateTime();
        $template->set('date', $date->format('Y-m-d H:i:s'));
        $generated = array();
        $methods = "";
        $tables = $this->adapter->getAllTables();
        foreach ($tables as $table) {
            //if table has more than one primary keys
            if(array_key_exists($table->getName(), $generated)) continue;
            $generated[$table->getName()] = true;
            
            $tableName = GeneratorHelper::getClazzName($table->getName());
            $columns = $this->adapter->getAllFields($table->getName());
            $methods .="   /**\n";
            $methods .="     * @return void\n";
            $methods .="     */\n";             
            $methods .="    public static function convert".$tableName."(".$tableName." $"."domain, Dto".$tableName." $"."dto)\n";
            $methods .="    {\n";
            foreach ($columns as $column) {
                $field = $column->getColumnName();
                $methods .="        $"."domain->set".$field."($"."dto->get".$field."())\n";           
            }
            $methods .="    }\n";           
        }
        $template->set(self::CONVERT_METHODS, $methods);            
        $template->write($this->filePath.DIRECTORY_SEPARATOR.'Domain2Dto.php'); 
    }
    /**
     * @param \Mokos\Template\Template $template
     * @param string $tableName name of database table
     */
    protected function fill(Template $template, $tableName) 
    {
        //do nothing
    }
    /**
     * @return string name suffix
     */
    protected function getType() 
    {
        return "";
    }
}