<?php
namespace Mokos;
/**
 * Description of Configuration
 *
 * @author derhaa
 */
class Configuration {

    private $DB_SERVER = "mysql";
    private $DB_HOST = "localhost";
    private $DB_PORT = "3306";
    private $DB_NAME = null;
    private $OUTPUT_DIR_PATH = null;
    
    public function getDbServer() {
        return $this->DB_SERVER;
    }

    public function getDbHost() {
        return $this->DB_HOST;
    }

    public function getDbPort() {
        return $this->DB_PORT;
    }

    public function getDbName() {
        return $this->DB_NAME;
    }

    public function getOutputDirPath() {
        return $this->OUTPUT_DIR_PATH;
    }


}