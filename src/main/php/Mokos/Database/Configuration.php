<?php
namespace Mokos\Database;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author tomascejka
 * @category   Database
 * @package    Database
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 *
 * Base interface database settings
 */
interface Configuration
{
    /**
     * @return \PDO
     */
    public function getConnection();
    /**
     * @return string database name
     */
    public function getDbName();
    /**
     * @return string directory path where files are be generated
     */
    public function getOutputDirPath();    
}