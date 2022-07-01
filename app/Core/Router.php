<?php

namespace App\Core;

class Router
{
    public static function getRoute(string $url): ?Route
    {
        $routes = require_once __DIR__ . '/../routes.php';
        return array_key_exists($url, $routes) ? $routes[$url] : null;
    }
}
