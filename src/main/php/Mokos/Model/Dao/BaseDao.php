<?php
namespace Mokos\Model\Dao;
use Mokos\Model\Dao\Dao;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author derhaa
 * @category   Data access layer
 * @package    Dao
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * Base implementation of data access object interface
 */
abstract class BaseDao implements Dao {
    /**
     * @var Storage data source implementation
     */
    protected $dataSource;
    /**
     * @return Storage data source implementation
     */
    protected function getDataSource () 
    {
        return $this->dataSource;
    }
}
