<?php
namespace Mokos\Database;
use Mokos\Database\Adapter\AdapterFactory;
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
     * @var Adapter\AdapterFactory
     */
    private static $adapterFactory;
    /**
     * @param \Mokos\Configuration $configuration
     * @return Adapter\Adapter
     */
    public function getAdapter(Configuration $configuration) 
    {
        if(self::$adapterFactory === null) self::$adapterFactory = new AdapterFactory();
        $adapter = self::$adapterFactory->getAdapter($configuration);
        return $adapter;
    }
}