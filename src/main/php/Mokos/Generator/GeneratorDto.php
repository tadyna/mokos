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
 * Generator for domain Entity objects
 */
class GeneratorDto extends GeneratorBase 
{
    /**
     * @return void
     */
    public function generate()
    {
        $tables = GeneratorHelper::getAllTables($this->adapter);
        $fields = "";
        $methods = "";
        foreach ($tables as $table) {
            $template = $this->getTemplate($table);
            $template->set(self::MARK_ANNOTATION, "@Dto");
            $columns = $this->adapter->getAllFields($table->getName());
            foreach ($columns as $column) {
                /** @var $column \Mokos\Database\Metadata\Column */
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
        return GeneratorHelper::getClazzName($tableName).'Dto'.$this->filePostfix.'.php';
    }
}