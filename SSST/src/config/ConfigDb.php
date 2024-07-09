<?php

namespace Almacen\Ssst\config;

use PDO;
use Exception;

class ConfigDb extends PDO {    

    public function __construct(){
        try {
          parent::__construct("mysql:local=localhost;dbname=SSST","ssst", "aoYL3gYWnDqDjCCQaeS4");
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
    }
}