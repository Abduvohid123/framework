<?php



$app= new Application();

$app->router->get('/',function (){
    return 'salom';
});

$app->run();
