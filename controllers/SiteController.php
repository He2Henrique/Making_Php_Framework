<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Request;

class SiteController extends Controller{

    public function home(){

        $params = [
            'hello' => "hello world"
        ];
        
        return $this->renderview('form', 'basic', $params);
    }

    public function handleData(Request $request){

        $body = $request->getBody();

        var_dump($body);

    }
    
}