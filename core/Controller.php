<?php

namespace App\core;


class Controller{

    public function renderview($view, $params){
        return Application::$app->router->render($view, $params);
    }
    
}