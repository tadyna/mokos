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
     * @param \Mokos\Template\Template $template
     * @param string $tableName name of database table
     */
    protected function fill(Template $template, $tableName) 
    {
        $template->set(self::MARK_ANNOTATION, "@Repository");
        $template->set(self::DESCRIPTION, "Repository for ".$this->getClazzName($tableName)." entity");
    }
    /**
     * @return string name suffix
     */
    protected function getType() 
    {
        return "Repository";
    }
}