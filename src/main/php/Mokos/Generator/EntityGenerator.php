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
class EntityGenerator extends BaseGenerator {
    /**
     * @param \Mokos\Template\Template $template
     * @param string $tableName name of database table
     */
    protected function _fill(Template $template, $tableName) {
        $clazzName = $this->_getClazzName($tableName);
        $template->set('domain_name', $clazzName);
        $columns = $this->_adapter->getAllFields($tableName);
        $fields = "";
        $methods = "";
        foreach ($columns as $column) {
            $columnName = $column->getFieldName();
            $field = $column->getColumnName();
            $type = $column->getType();
                //$fields .=($j==1) ? "/**\n" : "    /**\n";
            $fields .="    /**\n";
            $fields .="     * ".$column->getComment()."\n";
            $fields .="     * @var ".$type." ".$field.";\n";
            $fields .="     */\n";
            $fields .="    private \$_".$field.";\n";
            $methods .="    /**\n";
            $methods .="     * @return ".$type." $".$field.";\n";
            $methods .="     */\n";                
            $methods .="    public function get".$columnName."()\n";
            $methods .="    {\n" ;
            $methods .="        return \$this->_".$field.";\n";
            $methods .="    }\n";
            $methods .="    /**\n";
            $methods .="     *@param ".$type." $".$field.";\n";
            $methods .="     */\n";                
            $methods .="    public function set".$columnName."(\$".$field.")\n";
            $methods .="    {\n" ;
            $methods .="        \$this->_".$field."=\$".$field.";\n";
            $methods .="    }\n";            
        }
        $template->set('clazz_fields', $fields);
        $template->set('clazz_get_set_methods', $methods);
        $template->set('date', date("Y-m-d H:i"));
        $template->set('domain_description', "");
    }

    protected function _getType() {
        return "";
    }
}
