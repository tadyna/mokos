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
 * Generator for Mapper objects
 */
class GeneratorMapper extends GeneratorBase 
{
    /**
     * @param \Mokos\Template\Template $template
     * @param \Mokos\Database\Metadata\Table $table
     * @return bool
     */
    protected function processTable(Template $template, Table $table)
    {
        $template->set(self::MARK_ANNOTATION, "@Mapper");
        $template->set(self::DESCRIPTION, "Mapper for ".GeneratorHelper::getClazzName($table->getName())." entity");
        return true;
    }
    /**
     * @param string $tableName
     * @return string
     */
    public function getFilePath($tableName)
    {
        return GeneratorHelper::getClazzName($tableName).'Mapper'.$this->filePostfix.'.php';
    }
}