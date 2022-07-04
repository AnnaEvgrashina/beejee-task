<?php

use App\Controllers\MainController;
use App\Core\Route;

return [
    '/' => new Route(MainController::class, 'index'),
    '/create' => new Route(MainController::class, 'createTask'),
    '/update' => new Route(MainController::class, 'update'),
    '/updateTask' => new Route(MainController::class, 'updateTask'),
    '/login' => new Route(MainController::class, 'login'),
    '/auth' => new Route(MainController::class, 'auth'),
    '/logout' => new Route(MainController::class, 'logout'),
];