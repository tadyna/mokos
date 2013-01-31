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
     * @var Configuration
     */
    private $configurations;
    /**
     * @var Adapter\AdapterFactory
     */
    private $adapterFactory;
    /**
     * @param \Mokos\Configuration $configuration
     * @throws \Exception
     */
    public function __construct(Configuration $configuration) 
    {
        $this->configurations = $configuration;
        $this->adapterFactory = new AdapterFactory();
    }
    /**
     * @return Adapter\Adapter
     */
    public function getAdapter() 
    {
        $adapter = $this->adapterFactory->getAdapter($this->configurations);
        return $adapter;
    }
}