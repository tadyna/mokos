<?php
namespace Mokos\Generator;
use Mokos\Template\Template;
use Mokos\Database\Metadata\Table;
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
     * @var array of \Mokos\Database\Metadata\Table objects
     */
    private $tableWithPrimaryKeys;
    /**
     * @return void
     */
    protected function beforeGenerate()
    {
        $this->tableWithPrimaryKeys = GeneratorHelper::getTableWithPrimaryKey($this->adapter);
    }
    /**
     * @param \Mokos\Template\Template $template
     * @param \Mokos\Database\Metadata\Table $table
     * @return boolean true if process can go on
     */
    protected function processTable(Template $template, Table $table)
    {
        //if table does not have primary key, cannot be generated
        if(!array_key_exists($table->getName(), $this->tableWithPrimaryKeys)) return false;
        return true;
    }
    /**
     * @param string $tableName
     * @return string
     */
    public function getFilePath($tableName)
    {
        return GeneratorHelper::getClazzName($tableName).'Collection'.$this->filePostfix.'.php';
    }
}