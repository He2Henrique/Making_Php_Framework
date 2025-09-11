<?php

namespace App\controllers;

use App\core\Controller;

class SiteController extends Controller{

    public function home(){

        $params = [
            'hello' => "hello world"
        ];
        
        return $this->renderview('main', $params);
    }

    public function handleData(){
        
    }
    
}