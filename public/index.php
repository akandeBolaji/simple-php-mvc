<?php

use akandebolaji\phpmvc\Application;
use app\models\User;
use app\controllers\UserController;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->post('/api/v1/register', [UserController::class, 'register']);
$app->router->post('/api/v1/login', [UserController::class, 'login']);
$app->router->get('/api/v1/logout', [UserController::class, 'logout']);

$app->run(); 