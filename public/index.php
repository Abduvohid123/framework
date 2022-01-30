<?php

ini_set('display_errors', 1);

use app\core\Application;

require_once __DIR__ . "/../vendor/autoload.php";
$dotenv=\Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user'=>$_ENV['DB_USER'],
        'password'=>$_ENV['DB_PASSWORD']
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', function () {
    return 'salom';
});

$app->router->post('/contact', function () {
    return "postdan xabar keldi";
});

$app->router->get('/contact', 'contact');
$app->router->get('/home', 'home');


$app->router->post('/other_contact', [\app\controllers\SiteController::class, 'other_contact']);
$app->router->get('/massiv', [\app\controllers\SiteController::class, 'index']);


$app->router->post('login', [\app\controllers\AuthController::class, 'login']);
$app->router->get('/login', [\app\controllers\AuthController::class, 'login']);

$app->router->post('/register', [\app\controllers\AuthController::class, 'register']);
$app->router->get('/register', [\app\controllers\AuthController::class, 'register']);


$app->run();
