<?php

namespace Core;

class Request{
    
   public $main_root;

   public function __construct($main_root){
      $this->main_root = $main_root;
   }

   public function getpath(){

        //we can check if that is a main domain or other path
        // the variables changes a loot depends on what the main serve application is running.
        $path = $_SERVER["REQUEST_URI"] ?? '/';

        $path = str_replace($this->main_root,'',$path);

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
      if($this->getMethod() === 'GET'){
         foreach($_GET as $key => $_){
            $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
         }
      }

      if($this->getMethod() === 'POST'){
         foreach($_POST as $key => $_){
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
         }
      }
      return $body;
      
   }
}