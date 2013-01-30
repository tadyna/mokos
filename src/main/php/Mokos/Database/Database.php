<?php
namespace Mokos\Database;
use Mokos\Configuration;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author derhaa
 * @category   Database
 * @package    Database
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 */
class Database 
{
    /**
     * @var \ArrayObject 
     */
    private $configurations;
    /**
     * @param \Mokos\Configuration $configuration
     * @throws \Exception
     */
    public function __construct(Configuration $configuration) 
     {
        $this->dns = null;
        $this->dir = $configuration->getOutputDirPath();
        $server = $configuration->getDbServer();
        $host = $configuration->getDbHost();
        $port = $configuration->getDbPort();
        $db = $configuration->getDbName();
        switch($server)
        {
            case "mysql": 
                $dns='mysql:host='.$host.';port='.$port.';dbname='.$db; break;
            case "sqlsrv": //sqlsrv:Server=localhost,1521;Database=testdb
                $dns='sqlsrv:Server='.$host.','.$port.';Database='.$db; break;
            case "pgsql": //pgsql:host=localhost;port=5432;dbname=testdb;user=bruce;password=mypass
                $dns='pgsql:host='.$host.';port='.$port.';dbname='.$db; break; 
            case "sqlite": 
                $dns=$host; break;
            default:
                throw new \Exception("Unsupported database connection: ".$configurations);
        }        
    }
}
