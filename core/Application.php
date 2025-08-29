<?php

namespace App\core;

class Application{
    
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function run(){
        // u need to print the return to see the return from the function
        echo $this->router->resolve();
    }
    
}