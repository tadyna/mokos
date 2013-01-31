<?php
/**
 * Description of Configuration
 *
 * @author derhaa
 */
class Configuration implements Mokos\Database\Configuration
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
        return $GLOBALS['DB_DBNAME'];
    }
    /**
     * @inheritDoc
     */
    public function getOutputDirPath()
    {
        //do nothing
    }
}