<?php
namespace Mokos\Generator;
use Mokos\Template\Template;
use Mokos\Database\Metadata\Table;
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
 * Generator for domain Entity objects. It does not generate
 * primary key and column version. These columns are part of parent class.
 */
class GeneratorEntitySubclass extends GeneratorBase 
{
    /**
     * @return void
     */
    public function generate()
    {
        $relations = GeneratorHelper::getMethods($this->adapter);
        $collections = GeneratorHelper::getCollections($this->adapter);
        $tables = GeneratorHelper::getAllTables($this->adapter);
        $fields = "";
        $methods = "";
        foreach ($tables as $table) {
            $template = $this->getTemplate();
            $template->set(self::MARK_ANNOTATION, "@Entity");

            $tableName = $table->getName();
            if(array_key_exists($tableName, $collections)) {
                $template->set(self::COLLECTIONS, $collections[$tableName]);
            } else {
                $template->set(self::COLLECTIONS, "");
            }
            //generate relations
            if(array_key_exists($tableName, $relations)) {
                $lower = GeneratorHelper::getClazzNameLower($relations[$tableName]);
                $formated =str_replace("#", "$", $lower);
                $template->set(self::RELATIONS_METHODS, $formated);
            } else {
                $template->set(self::RELATIONS_METHODS, "");
            }

            $columns = $this->adapter->getAllFields($table->getName());
            foreach ($columns as $column) {
                /** @var $column \Mokos\Database\Metadata\Column */
                $columnName = $column->getFieldName();
                if($column->isPrimary() || $columnName === 'version') continue;
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
            $template->write($this->filePath.DIRECTORY_SEPARATOR.$this->getFilePath($table->getName()));
        }
    }
    /**
     * @param \Mokos\Template\Template $template
     * @param \Mokos\Database\Metadata\Table $table
     * @return boolean true if process can go on
     */
    protected function processTable(Template $template, Table $table)
    {
        // do nothing...
    }
    /**
     * @param string $tableName
     * @return string
     */
    public function getFilePath($tableName)
    {
        return GeneratorHelper::getClazzName($tableName).$this->filePostfix.'.php';
    }
}