<?php

namespace App\core;

class Application{

    public Router $router;
    public Request $request;
    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function run(){
        // u need to print the return to see the return from the function
        echo $this->router->resolve();
    }
    
}