<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @author derhaa 
 * @category   Entity
 * @package    Entity
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * Entity exception
 */
class EntityException extends \Exception {
    /**
     * @param type $message
     * @param type $code
     * @param type $previous
     */
    public function __construct($message, $code, $previous) {
        parent::__construct($message, $code, $previous);
    }
}
