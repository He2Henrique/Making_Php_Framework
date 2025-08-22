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
}