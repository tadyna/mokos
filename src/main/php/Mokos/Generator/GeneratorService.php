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
 * Generator for Service objects
 */
class GeneratorService extends GeneratorBase 
{
    /**
     * @param \Mokos\Template\Template $template
     * @param \Mokos\Database\Metadata\Table $table
     * @return bool
     */
    protected function processTable(Template $template, Table $table)
    {
        $template->set(self::MARK_ANNOTATION, "@Service");
        $template->set(self::DESCRIPTION, "Service for ".GeneratorHelper::getClazzName($table->getName())." entity");
        return true;
    }
    /**
     * @param string $tableName
     * @return string
     */
    public function getFilePath($tableName)
    {
        return GeneratorHelper::getClazzName($tableName).'Service'.$this->filePostfix.'.php';
    }
}