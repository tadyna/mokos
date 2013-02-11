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
                $inner = array();
                $counter1 = count($columns) - 1;
                $x = "";
                foreach ($columns as $column) {
                    $index = $counter1--;
                    $x .= "\t/*\n";
                    $x .= "\t * @param type pouzij metada column pro zjisteni typu \n";
                    $x .= "\t */\n";
                    $x .= "\tpublic function get_".$column->getColumnName()."s";
                    $methods[$columns[$index]->getReferencedTable()][] = $x;
                }
                
                $counter = 0;
                foreach ($columns as $column) {
                    $tab = $columns[$counter++]->getReferencedTable();
                    $position = 0;
                    if(array_key_exists($tab, $methods)){
                        if(array_key_exists($position, $methods[$tab])) {
                            $i = $position++;
                            $methods[$tab][$i].="_by_".$column->getColumnName()."(#id_".$column->getColumnName().");\n";
                        }                       
                    }
                }
//                foreach ($inner as $method) {
//                    $methods[$tableName][] = $method;
//                }
            } 
            // if table has primary key (eg. table with one2many relation(s))
            else 
            {
                $inner = array();
                $x = "";
                foreach ($columns as $column) {
                    $x = "\t/*\n";
                    $x .= "\t * @param type pouzij metada column pro zjisteni typu \n";
                    $x .= "\t */\n";                    
                    $x .= "\tpublic function get_".$tableName."s_by_".$column->getColumnName()."(#id_".$column->getColumnName().");\n";
                    $inner[] = $x;
                }                
                $methods[$tableName] = $inner;
            }
        }
        // End of refactor alpha implementation
        //////////////////////////////////////////////////////        
        $tables = $this->adapter->getAllTables();
        foreach ($tables as $table) {
            $tableName = $table->getName();
            if(!array_key_exists($tableName, $methods)) {
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
            
            ///////////////////////////////////////////////////
            //  Refactor this aplha implementation
            //  TODO [refactor]
            $inner = $methods[$tableName];
            $x = "";
            $i = 0;
            foreach ($inner as $hoo) {
                $formated = $this->getClazzNameLower($hoo);
                $x.=str_replace("#", "$", $formated);
//                $x .= ($i != 0) ? "\n" : "\n";
                $i++;
            }
            $template->set(self::RELATIONS_METHODS, $x );
            // End of refactor alpha implementation
            //////////////////////////////////////////////////////
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