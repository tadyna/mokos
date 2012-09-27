<?php
namespace Mokos\Generator;
use Mokos\Generator\Base;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author derhaa <dev.cejkatomas@gmail.com>
 * @category   Generator
 * @package    Expression package is undefined on line 15, column 18 in Templates/Scripting/PHPClass_1.php.
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * class description here ...
 */
class MysqlGenerator extends Base {
    
    protected function _getFields() {
        $colsByTable[] = array();
        foreach ($this->_pdo->query('describe '.$tableName) as $row) {
            $colsByTable[] = array(
                'field'    =>$row['Field'],
                'type'     =>$row['Type'],
                'is_null'  => (array_key_exists('NULL', $row)) ? $row['NULL'] === 'YES' ? true : false : false,
                'key'      =>$row['Key'],
                'is_unique'=>($row['Key'] === 'UNI') ? true : false,
                'is_primary'=>($row['Key'] === 'PRI') ? true : false,
                'default'  =>$row['Default'],
                'extra'    =>$row['Extra'],
            );
        }
        return $colsByTable;        
    }

    protected function _getTables() {
        return $this->_pdo->query('show tables');
    }

}
