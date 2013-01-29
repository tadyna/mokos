<?php
namespace Mokos\Model\Storage;
/**
 * Basic interface for data access storage implementation
 * LICENCE
 *   The MIT License
 *
 * @author derhaa
 * @category   Data access layer
 * @package    Storage
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 *
 */
interface Storage 
{
    /**
     * Concrete implementation must define a way how to insert given data
     * @param mixed $data
     * @return void
     */
    public function insert($data);
    /**
     * Concrete implementation must define a way how to update given data
     * @param mixed $data
     * @return void
     */
    public function update($data);
    /**
     * Storage engine must define how to remove data
     * @param mixed $data
     * @return void
     */
    public function delete($data);
    /**
     * Storage engine can invoke specific sql query
     * @param string $sql
     * @param array $params conditions for where clausule
     */
    public function fetchAll($sql, array $params = array());
    /**
     * Storage engine can invoke specific sql query
     * @return object entity
     */
    public function query($sql);
}