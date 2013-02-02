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
 * Generator for domain Entity objects. It does not generate
 * primary key and column version. These columns are part of parent class.
 */
class GeneratorEntitySubclass extends GeneratorBase 
{
    /**
     * @param \Mokos\Template\Template $template
     * @param string $tableName name of database table
     */
    protected function fill(Template $template, $tableName, $tableDescription) 
    {
        $template->set(self::MARK_ANNOTATION, "@Entity");
        $clazzName = $this->getClazzName($tableName);
        $template->set(self::DOMAIN_NAME, $clazzName);
        $columns = $this->_adapter->getAllFields($tableName);
        $fields = "";
        $methods = "";
        foreach ($columns as $column) {
            $columnName = $column->getFieldName();
            /*
             * primary key and version column is part of Entity class, eg. Mokos\Domain\Entity
             */
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
        $template->set('date', date("Y-m-d H:i"));
        $template->set(self::DOMAIN_DESCRIPTION, $tableDescription);
    }
    /**
     * @return string name suffix
     */
    protected function getType() 
    {
        return "";
    }
}