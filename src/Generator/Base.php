<?php
namespace Mokos\Generator;
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
abstract class Base {
    /**
     * @var string path to template file
     */
    private $_templatePath;
    /**
     * @var string path to directory where file will be generated 
     */
    private $_filePath;
    /**
     *
     * @var PHP Data Object
     */
    private $_pdo;
    /**
     * 
     * @param type $templatePath
     * @param type $filePath
     */
    public function __construct($templatePath, $filePath, \PDO $pdo) 
    {
        $this->_templatePath = $templatePath;
        $this->_filePath = $filePath;
        $this->_pdo = $pdo;
    }
    
    protected abstract function _getTables();
    protected abstract function _getFields();
}
