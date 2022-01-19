<?php

use app\core\Application;

require_once __DIR__ . "/../vendor/autoload.php";


$app= new Application(dirname(__DIR__));

$app->router->get('/',function (){
    return 'salom';
});

$app->router->get('/contact','contact');
$app->router->get('/home','home');
$app->router->post('/contact',function (){
    return "postdan xabar keldi";
});

$app->run();
