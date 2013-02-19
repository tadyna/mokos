<?php
namespace Mokos\Generator;
use Mokos\Template\Template;
use Mokos\Generator\GeneratorHelper;
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
class GeneratorDomain2Dto extends GeneratorBase 
{
    /**
     * @return void
     */
    public function generate()
    {
        $tables = GeneratorHelper::getAllTables($this->adapter);
        $methods = "";
        $generated = array();
        foreach ($tables as $table) {
            $template = $this->getTemplate($table);
            /** @var $table Mokos\Database\Metadata\Table  */
            if(array_key_exists($table->getName(), $generated)) return false;
            $generated[$table->getName()] = true;
            $tableName = GeneratorHelper::getClazzName($table->getName());
            $columns = $this->adapter->getAllFields($table->getName());
            $methods .="   /**\n";
            $methods .="     * @return void\n";
            $methods .="     */\n";
            $methods .="    public static function convert".$tableName."(".$tableName." $"."domain, ".$tableName."Dto $"."dto)\n";
            $methods .="    {\n";
            foreach ($columns as $column) {
                /** @var $column \Mokos\Database\Metadata\Column  */
                $field = $column->getColumnName();
                $methods .="        $"."dto->set".$field."($"."domain->get".$field."());\n";
            }
            $methods .="    }\n";
        }
        $template->set(self::CONVERT_METHODS, $methods);
        $template->write($this->filePath.DIRECTORY_SEPARATOR.$this->getFilePath($table->getName()));
    }
    /**
     * @param \Mokos\Template\Template $template
     * @param \Mokos\Database\Metadata\Table $table
     * @return void
     */
    protected function processTable(Template $template, Table $table)
    {
        //do nothing...
    }
    /**
     * @param string $tableName
     * @return string
     */
    protected function getFilePath($tableName)
    {
        return 'Domain2Dto.php';
    }
}