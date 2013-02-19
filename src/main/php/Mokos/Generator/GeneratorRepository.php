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
 * Generator for Repository objects
 */
class GeneratorRepository extends GeneratorBase 
{
    /**
     * Fill template by specific variables by given generator implementation
     * @param \Mokos\Template\Template $template
     * @param \Mokos\Database\Metadata\Table $table
     * @return void
     */
    protected function processTable(Template $template, Table $table)
    {
        //todo this must be called only one time
        $methods = GeneratorHelper::getMethods($this->adapter);
        $template->set(self::MARK_ANNOTATION, "@Repository");
        $tableName = $table->getName();
        if(array_key_exists($tableName, $methods)) {
            $lower = GeneratorHelper::getClazzNameLower($methods[$tableName]);
            $formated =str_replace("#", "$", $lower);
            $template->set(self::RELATIONS_METHODS, $formated);
        } else {
            $template->set(self::RELATIONS_METHODS, "");
        }
    }
    /**
     * @param string $tableName
     * @return string
     */
    public function getFilePath($tableName)
    {
        return GeneratorHelper::getClazzName($tableName).'Repository'.$this->filePostfix.'.php';
    }
}