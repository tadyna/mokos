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
 * @author derhaa <dev.cejkatomas@gmail.com>
 * @category   Generator
 * @package    Generator
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * class description here ...
 */
class DaoGenerator extends BaseGenerator {
    
    protected function _fill(Template $template, $tableName) {
        $template->set('domain_name', $this->_getClazzName($tableName));
        $template->set('table_name', $tableName);
        $template->set('date', date("Y-m-d H:i"));
    }

    protected function _getType() {
        return "Dao";
    }

}
