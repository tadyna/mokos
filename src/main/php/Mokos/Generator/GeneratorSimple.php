<?php
namespace Mokos\Generator;
use Mokos\Generator\Generator;
use Mokos\Template\Template;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author tomascejka
 * @category   Generator
 * @package    Generator
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * Class for generation various not database-based class
 */
class GeneratorSimple implements Generator 
{
    /**
     * @var string path to template file
     */
    private $templatePath;
    /**
     * @var string path to directory where file will be generated 
     */
    private $filePath;
    /**
     * @var string name of generated file 
     */
    private $fileName;    
    /**
     * @param string $templatePath
     * @param string $filePath
     * @param string $filePostfix
     * @param \Mokos\Database\AdapterBase $adapter
     */
    public function __construct($templatePath, $filePath, $fileName) 
    {
        $this->filePath = $filePath;
        $this->templatePath = $templatePath;
        $this->fileName = $fileName;
    }
    /**
     * Generate classes...
     * @return void
     */
    public final function generate () 
    {
        $template = new Template($this->templatePath);
        $template->write($this->filePath.DIRECTORY_SEPARATOR.$this->fileName.'.php');
    }
}