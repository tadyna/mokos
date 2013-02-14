<?php
use Mokos\Database\Configuration;
/**
 * Description of Configuration
 *
 * @author derhaa
 */
class ConfigurationTest implements Configuration
{
    /**
     * @var PDO
     */
    private static $pdo;
    /**
     * @return PDO
     */
    public function getConnection()
    {
        if(self::$pdo === null) self::$pdo = new \PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
        return self::$pdo;
    }
    /**
     * @inheritDoc
     */
    public function getDbName()
    {
        return $GLOBALS['DB_DATABASE'];
    }
    /**
     * @inheritDoc
     */
    public function getOutputDirPath()
    {
        //do nothing
    }
    /**
     * @inheritDoc
     */    
    public function getAppVersion()
    {
        return "0.1.1 alpha";
    }
    /**
     * @inheritDoc
     */
    public function getVendorName() {
        return $GLOBALS['DB_VENDOR'];
    }
}
