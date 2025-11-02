<?php
namespace App\core;

use App\core\Database;

class Model {

    public Database $connection;


    public function __construct($connection){
        $this->connection = $connection;
    }





    
}