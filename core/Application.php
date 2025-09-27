<?php

namespace App\core;

class Application{
    
    public static string $ROOT_DIR;
    public static Application $app;
    public static $_CONFIGS;
    public Router $router;
    public Request $request;
    public ResponseStatusCode $response;
    public function __construct($rootPath)
    {
        //static property of the aplication
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        self::$_CONFIGS = Config::SetConfigurations(__DIR__.'\..\.env');
        
        //Modify property of the aplication
        $this->response = new ResponseStatusCode();
        $this->request = new Request();
        $this->router = new Router($this->request, $this->response);

        var_dump($rootPath);
        var_dump(self::$_CONFIGS);

    }

    public function run(){
        // u need to print the return to see the return from the function
        echo $this->router->resolve();
    }
    
}