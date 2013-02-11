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
            $template->set(self::TABLE_NAME_SIMPLE, $this->getTableNameSimple($tableName));
            $template->set(self::DOMAIN_NAME, $this->getClazzName($tableName));
            $template->set(self::DOMAIN_NAME_LOWER, $this->getClazzNameLower($tableName));
            $template->set(self::DESCRIPTION, $table->getDescription());
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
        // do nothing ... 
    }
    /**
     * @return string name suffix
     */
    protected function getType() 
    {
        return "Collection";
    }
    /**
     * @return array key is table name and value is Mokos\Database\Metadata\Table object
     */
    private function createRelationshipMethods()
    {
        $foreignKeys = $this->adapter->getTablesWithPrimaryKey();
        $relations = $this->adapter->getRelations();
        $methods = array();
        foreach ($relations as $tableName => $table){
            // if table has no primary key (eg. many2many table)
            $columns = $table->getColumns();
            if(array_search($tableName, $foreignKeys, true) == null) 
            {
                $inner = array();
                $counter = count($columns) - 1;
                foreach ($columns as $column) {
                    $cIndex = $columns[$counter--];
                    $methods[$cIndex][] = "get_".$column."";
                }
                $counter1 = 0;
                foreach ($columns as $column) {
                    $tab = $columns[$counter1++];
                    $position = 0;
                    if(array_key_exists($tab, $methods)){
                        if(array_key_exists($position, $methods[$tab])) {
                            $methods[$tab][$position++].="s_by_".$column."(#id_".$column.");";
                        }                       
                    }
                }
            } 
            // if table has primary key (eg. table with one2many relation(s))
            else 
            {
                $inner = array();
                foreach ($columns as $column) {
                    $inner[] = "get_".$tableName."s_by_".$column."(#id_".$column.");";
                }                
                $methods[$tableName] = $inner;
            }
        }
        return $methods;
    }
}