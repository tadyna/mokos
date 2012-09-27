<?php
namespace Mokos\Generator;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @abstract
 * @author derhaa <dev.cejkatomas@gmail.com>
 * @category   Database
 * @package    Database
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * class description here ...
 */
class RowMapper {

    private $field;
    private $type;
    private $nullable;
    private $key;
    private $unique;
    private $primary;
    
    public function __construct($field, $type, $nullable, $key, $unique, $primary) {
        $this->field = $field;
        $this->type = $type;
        $this->nullable = $nullable;
        $this->key = $key;
        $this->unique = $unique;
        $this->primary = $primary;
                
    }
    public function getField() {
        return $this->field;
    }

    public function getType() {
        return $this->type;
    }

    public function getNullable() {
        return $this->nullable;
    }

    public function getKey() {
        return $this->key;
    }

    public function getUnique() {
        return $this->unique;
    }

    public function getPrimary() {
        return $this->primary;
    }
}