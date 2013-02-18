<?php
namespace Mokos\Generator;
use Mokos\Generator\Generator;
use Mokos\Database\Adapter\AdapterBase;
use Mokos\Template\Template;
use Mokos\Generator\GeneratorHelper;
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
 * Base class for generation of various classes
 */
abstract class GeneratorBase implements Generator 
{
    const APP_VERSION = 'version';
    const MARK_ANNOTATION = 'mark_annotation';
    const TABLE_NAME_SIMPLE = 'table_name_simple';
    const DOMAIN_NAME = 'domain_name';
    const DOMAIN_NAME_LOWER = 'domain_name_lower';
    const DESCRIPTION = 'domain_description';
    const CLAZZ_FIELDS = 'clazz_fields';
    const CLAZZ_GET_SET_METHODS = 'clazz_get_set_methods';
    const CLAZZ_SERIALIZATION = 'clazz_serialize';
    const CLAZZ_UN_SERIALIZATION = 'clazz_deserialize';
    const EMPTY_CLASS = "empty_class";
    const EMPTY_METHOD = "empty_method";
    const DOMAIN_GET_PRIMARY_METHOD = "domain_get_primary_method";
    const RELATIONS_METHODS = "relations_methods";
    const CONVERT_METHODS = 'convert_methods';
    const DATE = 'date';
    const DOMAIN_PRIMARY_KEY = 'domain_primary_key';
    /**
     * @var \Mokos\Database\Adapter\Adapter
     */
    protected $adapter;
    /**
     * @var string path to template file
     */
    protected $templatePath;
    /**
     * @var string path to directory where file will be generated 
     */
    protected $filePath;
    /**
     * @var string name of postfix for filename
     */
    protected $filePostfix;
    /**
     * @param string $templatePath
     * @param string $filePath
     * @param string $filePostfix
     * @param \Mokos\Database\Adapter\Adapter $adapter
     */
    public function __construct($templatePath, $filePath, $filePostfix, AdapterBase $adapter) 
    {
        $this->filePath = $filePath;
        $this->templatePath = $templatePath;
        $this->adapter = $adapter;
        $this->filePostfix = $filePostfix;
    }
    /**
     * Generate classes...
     * @return void
     */
    public function generate () 
    {
        $tables = GeneratorHelper::getAllTables($this->adapter);
        foreach ($tables as $table) {
            /** @var \Mokos\Database\Metadata\Table $table */
            $tableName = $table->getName();
            $template = new Template($this->templatePath);
            $date = new \DateTime();
            $template->set(self::DATE, $date->format('Y-m-d H:i:s'));
            $template->set(self::EMPTY_CLASS, "//TODO class implementation");
            $template->set(self::EMPTY_METHOD, "//TODO method implementation");
            $template->set(self::TABLE_NAME_SIMPLE, GeneratorHelper::getTableNameSimple($tableName));
            $template->set(self::DOMAIN_NAME, GeneratorHelper::getClazzName($tableName));
            $template->set(self::DOMAIN_PRIMARY_KEY, $table->getPrimaryKeyColumnName());
            $template->set(self::DOMAIN_NAME_LOWER, GeneratorHelper::getClazzNameLower($tableName));
            $template->set(self::DESCRIPTION, $table->getDescription());
            $this->fill($template, $tableName);
            $template->write($this->filePath.DIRECTORY_SEPARATOR.GeneratorHelper::getClazzName($tableName).$this->getType().$this->filePostfix.'.php');
        }
    }    
    /**
     * Fill template by specific variables by given generator implementation
     * @return void
     */
    protected abstract function fill(Template $template, $tableName);
    /**
     * Returned name is used in filename
     * @return string of generated entity, eg. Dao, Mapper, Repository
     */
    protected abstract function getType();
}