<?php
namespace Mokos\Generator;
use Mokos\Database\AdapterBase;
use Mokos\Template\Template;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author tomascejka <dev.cejkatomas@gmail.com>
 * @category   Generator
 * @package    Generator
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * class description here ...
 */
abstract class BaseGenerator {
    /**
     * @var AdapterBase
     */
    protected $_adapter;
    /**
     * @var string path to template file
     */
    private $_templatePath;
    /**
     * @var string path to directory where file will be generated 
     */
    private $_filePath;
    
    public function __construct($templatePath, $filePath, AdapterBase $adapter) 
    {
        $this->_filePath = $filePath;
        $this->_templatePath = $templatePath;
        $this->_adapter = $adapter;
    }
    /**
     * Generate classes...
     */
    public final function generate () 
    {
        $tables = $this->_adapter->getAllTables();
        $i = 0;
        foreach ($tables as $table) {
            if($i > 0) continue;//metatabulka
            $tableName = $table[0];
            $clazzName = $this->_getClazzName($tableName);
            $template = new Template($this->_templatePath);
            $this->_fill($template, $tableName);
            $template->write($this->_filePath.$clazzName.$this->_getType().'.class.php');
        }
    }
    /**
     * Give table name and upperCase first letter in name,
     * and if table contains '_' removed than and use camel-based naming class
     * @return string name of table for class
     */
    protected function _getClazzName($tableName)
    {
        $name = strtoupper($tableName[0]).substr($tableName,1);
        for($i=0;$i<strlen($name);$i++){
            if($name[$i]=='_'){
                $name = substr($name, 0, $i).strtoupper($name[$i+1]).substr($tableName, $i+2);
            }
        }
        return $name;
    }
    protected abstract function _fill(Template $template, $tableName);
    protected abstract function _getType();
}
