<?php
use Mokos\Model\Dao\BaseDao;
/**
 * @date: ${date}
 */
class ${domain_name}Mapper extends MapperZF
{
    /**
     *
     */
    public final function findById($idEntity)
    {
        $sql = 'select * from ${table_name} where ${primary_key}=$idEntity';
        $this->getDataSource->sql();
    }
}