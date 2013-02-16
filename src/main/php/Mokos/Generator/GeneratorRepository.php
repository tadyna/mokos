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
        ///////////////////////////////////////////////////
        //  Refactor this aplha implementation
        //  TODO [refactor]
        $tablesF = $this->adapter->getTablesWithPrimaryKey();
        $methods = array();
        //foreach ($this->adapter->getRelations() as $tableName => $columns){
       foreach ($this->adapter->getRelations() as $table){
            $columns = $table->getColumns();
            $tableName = $table->getName();
            // if table has no primary key (eg. many2many table)
            if(array_search($tableName, $tablesF, true) == null) 
            {
                $counter = 0;
                $x = "";
                foreach ($columns as $column) {
                    $x .= "\t/*\n";
                    $x .= "\t * Add ".$column->getColumnName()." objects to repository \n";
                    $x .= "\t * @param array ".$column->getColumnName()." objects \n";
                    $x .= "\t */\n";
                    $x .= "\tpublic function add_".$column->getColumnName()."s(array $".$column->getColumnName()."s){}\n";
                    $x .= "\t/*\n";
                    $x .= "\t * Remove ".$column->getColumnName()." objects from repository \n";
                    $x .= "\t * @param array ".$column->getColumnName()." objects. If it is null remove all related ".$column->getColumnName()." objects \n";
                    $x .= "\t */\n";
                    $x .= "\tpublic function remove_".$column->getColumnName()."s(array $".$column->getColumnName()."s = null){}\n";                    
                    $methods[$columns[$counter++]->getReferencedTable()][] = $x;
                }
            } 
            // if table has primary key (eg. table with one2many relation(s))
            else 
            {
                $x = "";
                foreach ($columns as $column) {
                    $x .= "\t/*\n";
                    $x .= "\t * Add ".$column->getColumnName()." objects to repository \n";
                    $x .= "\t * @param array ".$column->getColumnName()." objects \n";
                    $x .= "\t */\n";
                    $x .= "\tpublic function add_".$column->getColumnName()."s(array $".$column->getColumnName()."s){}\n";
                    $x .= "\t/*\n";
                    $x .= "\t * Remove ".$column->getColumnName()." objects from repository \n";
                    $x .= "\t * @param array ".$column->getColumnName()." objects. If it is null remove all related ".$column->getColumnName()." objects \n";
                    $x .= "\t */\n";
                    $x .= "\tpublic function remove_".$column->getColumnName()."s(array $".$column->getColumnName()."s = null){}\n";  
                    $methods[$tableName] = $x;
                }
            }
        }
        // End of refactor alpha implementation
        //////////////////////////////////////////////////////        
        $tables = $this->adapter->getAllTables();
        foreach ($tables as $table) {
            $tableName = $table->getName();
            $template = new Template($this->templatePath);
            $template->set(self::MARK_ANNOTATION, "@Repository");
            $date = new \DateTime();
            $template->set('date', $date->format('Y-m-d H:i:s'));
            $template->set(self::EMPTY_CLASS, "//TODO class implementation");
            $template->set(self::EMPTY_METHOD, "//TODO method implementation");
            $template->set(self::TABLE_NAME_SIMPLE, $this->getTableNameSimple($tableName));
            $template->set(self::DOMAIN_NAME, $this->getClazzName($tableName));
            $template->set(self::DOMAIN_NAME_LOWER, $this->getClazzNameLower($tableName));
            $template->set(self::DESCRIPTION, $table->getDescription());
            //generate relations
            if(array_key_exists($tableName, $methods)) {
                $lower = $this->getClazzNameLower($tableName);
                $formated =str_replace("#", "$", $lower);              
                $template->set(self::RELATIONS_METHODS, $formated);
            } else {
                $template->set(self::RELATIONS_METHODS, "");
            }
            $this->fill($template, $tableName);
            $template->write($this->filePath.DIRECTORY_SEPARATOR.$this->getClazzName($tableName).$this->getType().$this->filePostfix.'.php');            
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