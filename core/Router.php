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
            return $this->renderTagsInView($callback);
        }
        return call_user_func($callback);
    
    }

    //Component main -> they have some tags that u specifiy
    // this component can have 1 or more tags
    // to each tag the aplication will render this component
    // func component(component)-> return the component
    // the return will replace the tags
    // func(page) -> foreach tag -> local replace local[start, end] to component
    // component can have parameters
    

    public function renderTagsInView($view){
        $regex = "/\{\{(.*?)\}\}/";
        $viewcontent = $this->renderOnlyView($view);
        
        preg_match_all($regex, $viewcontent, $matches);
        foreach($matches[1] as $match){
            
            $componentContent = $this->renderderContent($match);
            $viewcontent = preg_replace($regex, $componentContent, $viewcontent);
        }
        return $viewcontent;
    }

    public function renderOnlyView($view){

        ob_start();
        require_once Application::$ROOT_DIR."/../views/$view.php";
        return ob_get_clean();// cleans the buffer when the content is returned
    
    }

    public function renderderContent($tag){
        ob_start();
        require_once Application::$ROOT_DIR."/../views/components/$tag.php";
        return ob_get_clean();// cleans the buffer when the content is returned
    }

    //next steps is implements a way to use recursion because a component can have another components...
    // and a why to pass parameters to the components.
}