<?php



namespace Core;

use PDO;


class DataBase{

    public PDO $pdo;
    public $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    public function __construct($VAR){
        $this->pdo = new PDO($VAR['DB_DSN'], $VAR['DB_USER'], $VAR['DB_PASSWORD'], $this->options);
    }

    public function get_statement($query){
        
        return $this->pdo->prepare($query);

    }
    
}