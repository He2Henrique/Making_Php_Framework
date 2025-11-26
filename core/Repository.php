<?php

namespace Core;

use Core\Database;
use Core\Application;
use Exception;
use PDO;

abstract class Repository {

    protected Database $connection;
    protected string $table;

    public function __construct(){
        $this->connection = Application::$DatabaseConnetion;
    }

    public function setTableName(string $table){
        $this->table = $table;
    }

    public function getAll(){
       $stmt = $this->connection->get_statement("SELECT * from $this->table");
       $stmt->execute();

       return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findAllBy(string $fiel_name, string $value){
       $stmt = $this->connection->get_statement("SELECT * from $this->table where $fiel_name = :value_");

       $stmt->bindValue(':value_', $value , PDO::PARAM_STR);

       $stmt->execute();

       return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(string $id_field, string $value){
       $stmt = $this->connection->get_statement("SELECT * from $this->table where $id_field = :value_");

       $stmt->bindValue(':value_', $value , PDO::PARAM_STR);

       $stmt->execute();

       return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteById(string $id_field, string $value){
       $stmt = $this->connection->get_statement("DELETE FROM `{$this->table}` where $id_field = :value_");

       $stmt->bindValue(':value_', $value , PDO::PARAM_STR);

       $stmt->execute();
    }

    public function GetTableInfo(){
      
      $stmt = $this->connection->get_statement("SHOW COLUMNS FROM `{$this->table}`");

       $stmt->execute();

       return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function execute_sql(string $sql, array $values){
      try{
         $stmt = $this->connection->get_statement($sql);
         $stmt->execute($values);
      }catch(Exception $e){
         echo $e->getCode();
      }
    }


}