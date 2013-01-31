<?php
/**
 * Description of PdoFactory
 *
 * @author tomascejka
 */
class PdoFactory 
{
    /**
     * PDO implementation
     * @var \PDO
     */
    private static $pdo;
    /**
     * @var string name of database
     */
    private static $database;
    /**
     */
    public function __construct() 
    {
        self::$database = $GLOBALS['DB_DATABASE'];
    }
    /**
     * @return string get name of database
     */
    public static function getDatabaseName() 
    {
        return self::$database;
    }
    /**
     * Create/Return PDO object
     * @return \PDO object
     */
    public static function createConnection(){
        if(self::$pdo === null) self::$pdo = new \PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
        return self::$pdo;
    }
}