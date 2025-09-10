<?php

use App\core\Application;

require_once __DIR__.'/../vendor/autoload.php';


$app = new Application(__DIR__);


$app->router->get('/home', [SiteController::class, 'home']);
$app->router->post('/home', [SiteController::class, 'home']);

$app->run();