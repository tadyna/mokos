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
 * Generator for domain Entity objects
 */
class GeneratorRepository extends GeneratorBase {
    /**
     * @param \Mokos\Template\Template $template
     * @param string $tableName name of database table
     */
    protected function fill(Template $template, $tableName, $tableDescription) {
        $template->set(self::MARK_ANNOTATION, "@Repository");
        $template->set(self::TABLE_NAME_SIMPLE, $this->getTableNameSimple($tableName));
        $template->set(self::DOMAIN_NAME, $this->getClazzName($tableName));
        $template->set(self::DOMAIN_NAME_LOWER, $this->getClazzNameLower($tableName));
        $template->set(self::DOMAIN_DESCRIPTION, "Repository for ".$this->getClazzName($tableName)." entity");
    }
    /**
     * @return string name suffix
     */
    protected function getType() {
        return "Repository";
    }
}