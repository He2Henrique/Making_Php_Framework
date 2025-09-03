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
            //another funcion here that process the variables
            // if there are "" declare string and the value, if in 1-9 declare as a int or if start as $ connect to a var
            // but how can i connect to a var?
            
            // in the render content need be a thing thats permits pass the params
            $componentContent = $this->renderderContent($match);
            $viewcontent = preg_replace($regex, $componentContent, $viewcontent);
        }
        return $viewcontent;
    }

    function NumericType($valor) {
        if (!is_numeric($valor)) {
            return null;
        }

        // Contém ponto ou notação científica (e/E) → float
        if (strpos($valor, ".") !== false || stripos($valor, "e") !== false) {
            return "float";
        }

        return "int";
    }

    function isvar($valor) {
        if (substr_count($valor, '$') === 1){
            return true;
        }
        return false;
    }

    public function processTokens($tokens){

        $list_params = [];
        
        foreach($tokens as $token){
            $pairs = preg_split("/\=/", $token);

            if($this->NumericType($token) == "int"){
                $value = (int)$token;
            }else if($this->NumericType($token) == "float"){
                $value = (float)$token;
            }else if($this->isvar($token)){
                $value = null; // not any idea
            }
            
            $list_params[$pairs[0]];
            
        }
        
    }

    public function renderView($view, $params){
        $regex = "/\{\{(.*?)\}\}/";
        $__PARAMS__ = $params;// i think that i can create a class to get the values of the params
        
        ob_start();
        require_once Application::$ROOT_DIR."/../views/$view.php";

        $content = ob_get_contents();

        preg_match_all($regex, $content, $matches);
        foreach($matches[1] as $match){
            $tokens = preg_split("/\s+/", $match);

            $list_params = $this->processTokens($tokens);

        }
        

        

        
    }

    // i want to render content trhow the view but is difficult

    public function renderOnlyView($view){

        ob_start();
        require_once Application::$ROOT_DIR."/../views/$view.php";

        
        // the way is to take the intermediary way to render the content:
        $content = ob_get_contents();
        // find {{...}} pathern 
        // break in some bit by the caracter " "
        // to fist is the name of component
        // ohters is variables ...=<values>
        // " " is string
        // (1-9) or (1-9.1-9) int or float
        // $... variable => in this function returning for the value $result = $$value
        
        //i think is better to return a assietive array whith params, and the string
        
        
        return ob_get_clean();
        
        // cleans the buffer when the content is returned
    
    }

    public function renderderContent($tag){
        ob_start();
        require_once Application::$ROOT_DIR."/../views/components/$tag.php";
        return ob_get_clean();// cleans the buffer when the content is returned
    }

    //next steps is implements a way to use recursion because a component can have another components...
    // and a why to pass parameters to the components.


    // i want to render content trhow the view but is dificult
    public function LoadaParams(){}
}