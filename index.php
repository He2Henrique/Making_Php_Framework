<?php

use App\core\Application;

require_once __DIR__.'/vendor/autoload.php';


$app = new Application();


$app->router->get('/', function(){
    echo "hello world";
});

$app->run();