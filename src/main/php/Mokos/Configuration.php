<?php
namespace Mokos;
/**
 * Description of Configuration
 *
 * @author derhaa
 */
class Configuration implements Database\Configuration
{
    private $DB_SERVER = "mysql";
    private $DB_HOST = "localhost";
    private $DB_PORT = "3306";
    private $DB_USER = "";
    private $DB_PASSWORD = "";
    private $DB_NAME = null;
    private $OUTPUT_DIR_PATH = null;
    /**
     * @var \PDO
     */
    private static $pdo;
    /**
     * @return \PDO
     * @throws \Exception
     */
    public function getConnection()
    {
        if(self::$pdo === null) {
            switch($this->DB_SERVER) {
                case "mysql": 
                    $dns='mysql:host='.$this->DB_HOST.';port='.$this->DB_PORT.';dbname='.$this->DB_NAME; break;
                case "mssql": //sqlsrv:Server=localhost,1521;Database=testdb
                    $dns='sqlsrv:Server='.$this->DB_HOST.','.$this->DB_PORT.';Database='.$this->DB_NAME; break;
                case "pgsql": //pgsql:host=localhost;port=5432;dbname=testdb;user=bruce;password=mypass
                    $dns='pgsql:host='.$this->DB_HOST.';port='.$this->DB_PORT.';dbname='.$this->DB_NAME; break; 
                case "sqlite": 
                    $dns=$this->DB_HOST; break;
                default:
                    throw new \Exception("Unsupported database connection - host:".$this->DB_HOST.", port:".$this->DB_PORT.", database:".$this->DB_NAME);
            }
            self::$pdo = new \PDO($dns, $this->DB_USER, $this->DB_PASSWORD);
        }
        return self::$pdo;
    }
    /**
     * @return string database name
     */
    public function getDbName() 
    {
        return $this->DB_NAME;
    }
    /**
     * @return string directory path where files are be generated
     */
    public function getOutputDirPath() 
    {
        return $this->OUTPUT_DIR_PATH;
    }
}