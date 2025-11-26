<?php


namespace Core;


class Controller{

    public function renderview($view, $layout, $params=[]){
        return Application::$app->router->render($view, $layout, $params);
    }
    
}