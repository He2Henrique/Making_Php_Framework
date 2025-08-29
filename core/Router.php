<?php

namespace App\core;

// we will use routes to config the functions that will call through a url path
class Router{

    protected array $routes = [];
    public Request $request;
    public ResponseStatusCode $response;

    
    public function __construct($request, $response){
        $this->request = $request;
        $this->response = $response;
    }
    
    public function get($path, $callback){
        $this->routes['GET'][$path] = $callback; 
    }

    public function resolve(){
        //there are just two forms to pass callback as a funtion o string
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if($callback === false){
            $this->response->SetStatusCode(404);
            return "Not Found";
        }
        if(is_string($callback)){
            return $this->renderView($callback);
        }
        return call_user_func($callback);
    
    }

    public function renderView($view){

        
        $layoutContent = $this->renderLayout();
        $viewcontent = $this->renderOnlyView($view);
        return str_replace('{{content}}', $viewcontent, $layoutContent);
    
    }

    public function renderLayout(){

        ob_start();
        require_once Application::$ROOT_DIR."/../views/layouts/main.php";
        return ob_get_clean();
    }


    public function renderOnlyView($view){

        ob_start();
        require_once Application::$ROOT_DIR."/../views/$view.php";
        return ob_get_clean();// cleans the buffer when the content is returned
    
    }
}