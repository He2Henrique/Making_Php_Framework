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
    
    //here you define the routes, to after u we call
    public function get($path, $callback){
        // echo "$path, $callback";
        $this->routes['GET'][$path] = $callback; 
    }

    public function post($path, $callback){
        $this->routes['POST'][$path] = $callback; 
    }

    public function resolve(){
        //there are just two forms to pass callback as a funtion o string
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        // echo "\n $path, $method \n";

        $callback = $this->routes[$method][$path] ?? false;
        if($callback === false){
            $this->response->SetStatusCode(404);
            return $this->render("_404");
        }
        if(is_string($callback)){
            return $this->render($callback);
        }
        if(is_array($callback)){
            $callback[0] = new $callback[0]();
        }
        return call_user_func($callback, $this->request);
    
    }

    public function render($view, $layout=false, $params=[]){

        $viewcontent = $this->renderOnlyView($view, $params);
        
        if(!$layout){
            return $viewcontent;
        }

        $layoutContent = $this->renderderlayout($layout);
         
        // preg_repla... is use to patterns and str_replace is use to literal strings.
        return str_replace('{{content}}', $viewcontent, $layoutContent);
        
    }

    public function renderOnlyView($view, $params){

        ob_start();
        foreach($params as $key => $value){
            $$key = $value;
        }
        require_once Application::$ROOT_DIR."/../views/$view.php";
        return ob_get_clean();// cleans the buffer when the content is returned

    }
    public function renderderlayout($layout){
        ob_start();
        require_once Application::$ROOT_DIR."/../views/layouts/$layout.php";
        return ob_get_clean();// cleans the buffer when the content is returned
    }

    // public function renderViewsinTemplate($template){
    //     $regex = "/\{\{(.*?)\}\}/";
    //     $teamplateContent = $this->renderderContent($template);
        
        
    //     preg_match_all($regex, $teamplateContent, $matches);
    //     foreach($matches[1] as $match){
            
    //         $viewcontent = $this->renderOnlyView($match);
    //         $teamplateContent = preg_replace($regex, $viewcontent, $teamplateContent);
    //     }
    //     return $teamplateContent;
    // }

    // i need to change this
    // we have templates of the site 
    //inside we got views
    // but in view we can have another thing it call cards
    //can load multiple views. inside one template

}