<?php
use Mokos\Model\Dao\BaseDao;
/**
 * @date: ${date}
 */
class ${domain_name}Dao extends BaseDao 
{
    /**
    * Get all records from storage ordered by field
    * @final
    * @param $orderColumn column name
    */
    public final function findAll($orderColumn)
    {
        $sql = 'SELECT * FROM ${table_name} ORDER BY '.$orderColumn;
        return $this->_storage()->query($sql);
    }
    /**
    * Get all records from storage ordered by field
    * @final
    * @param $orderColumn column name
    */
    public final function findAll($orderColumn)
    {
        $sql = 'SELECT * FROM ${table_name} ORDER BY '.$orderColumn;
        return $this->_storage()->query($sql);
    }    
}