<?php

namespace App\core;

class Request{
    
   public function getpath(){

        //we can check if that is a main domain or other path
        $path = $_SERVER["REQUEST_URI"] ?? '/';
        // but request can pass more information by the url 
        // so we need to capture what is path and what is parameters
        $positon = strpos($path,'?');
        if($positon === false){
            return $path;
        }
        //return just the path.
        return substr($path, 0, $positon);
   }
   
   public function getMethod(){
      return $_SERVER["REQUEST_METHOD"];
   }

   public function getBody(){
      $body= [];
      echo $this->getMethod();
      if($this->getMethod() === 'GET'){
         echo 'get';
         foreach($_GET as $key => $_){
            echo $key;
            $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
         }
      }

      if($this->getMethod() === 'POST'){
         echo 'post <br>';
         var_dump($_POST);
         foreach($_POST as $key => $_){
            echo $key;
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
         }
      }
      return $body;
      
   }
}