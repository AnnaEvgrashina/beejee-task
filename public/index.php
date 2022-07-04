<?php

require_once __DIR__ . '/../vendor/autoload.php';

$env = new \Symfony\Component\Dotenv\Dotenv(true);
$env->load(__DIR__ . '/../.env');

if ($_ENV['DEBUG']) {
    error_reporting(E_ALL);
}

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../app/Views/');
$twig = new \Twig\Environment($loader);

$url = parse_url($_SERVER['REQUEST_URI'])['path'];
$route = \App\Core\Router::getRoute($url);
if (is_null($route)) {
    echo "Route {$url} not found";
    die;
}
$request = new \App\Core\Request();
$controller = new $route->controller;
$action = $route->action;
echo $controller->$action($request);