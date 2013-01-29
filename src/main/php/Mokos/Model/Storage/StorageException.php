<?php
namespace Mokos\Dao;
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
 * Basic storage exception
 */
class StorageException extends Exception 
{
    public function __construct($message, $code, $previous) 
    {
        parent::__construct($message, $code, $previous);
    }
}