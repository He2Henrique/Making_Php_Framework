<?php

use App\core\Application;

require_once __DIR__.'/../vendor/autoload.php';


$app = new Application(__DIR__);


$app->router->get('/', function(){
    echo "hello world";
});

$app->router->get('/main', function(){
    echo "My friend";
});

$app->router->get('/con', 'casa');

$app->run();