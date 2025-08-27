<?php

use App\core\Application;

require_once __DIR__.'/../vendor/autoload.php';


$app = new Application();


$app->router->get('/', function(){
    echo "hello world";
});

$app->router->get('/main', function(){
    echo "My friend";
});

$app->router->get('/con', 'contact');

$app->run();