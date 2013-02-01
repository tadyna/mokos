<?php
namespace Mokos\Database\Adapter;
use Mokos\Database\Configuration;
use Mokos\Database\Adapter\AdapterMssql;
use Mokos\Database\Adapter\AdapterMysql;
use Mokos\Database\Adapter\AdapterPosgreSql;
use Mokos\Database\Adapter\AdapterSqlLite;
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
 * Base interface create database adapters
 */
class AdapterFactory 
{
    /**
     * @param string $vendorName name of database vendor, eg. mysql | psgl etc.
     * @return Mokos\Database\Adapter
     * @throws \Exception if vendor is not supported/founded
     */
    public function getAdapter(Configuration $configuration) 
    {
        /** @var Mokos\Database\Adapter */
        $adapter = null;
        switch($configuration->getDbName())
        {
            case "mysql": 
                $adapter = new AdapterMysql($configuration); break;
            case "mssql": //sqlsrv:Server=localhost,1521;Database=testdb
                $adapter = new AdapterMssql($configuration); break;
            case "pgsql": //pgsql:host=localhost;port=5432;dbname=testdb;user=bruce;password=mypass
                $adapter = new AdapterPosgreSql($configuration); break; 
            case "sqlite": 
                $adapter = new AdapterSqlLite($configuration); break;
            default:
                throw new \Exception("Unsupported database connection: ".$configuration);
        }
        return $adapter;
    }
}