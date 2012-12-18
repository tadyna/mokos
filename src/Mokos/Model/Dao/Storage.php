<?php
namespace Mokos\Model\Dao;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @author derhaa
 * @category   Data access layer
 * @package    Dao
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * Basic interface for Data Access Object pattern
 */
interface Storage {
    /**
     * Concrete implementation must define a way how to save given data
     * @param mixed $data
     * @return void
     */
    public function save($data);
    /**
     * Storage engine must define how to remove data
     * @param mixed $data
     * @return void
     */
    public function delete($data);
    /**
     * Storage engine must implement how to find entity by given unique id
     * @param mixed $id
     * @return object entity
     */
    public function find($id);
    /**
     * Storage engine must implement how to find set of entities
     * @param array $condition filter rule for final result
     * @return object collection of entities
     */
    public function findAll(array $condition = array());
    /**
     * Storage engine can invoke specific sql query
     * @return object entity
     */
    public function query($sql);
}