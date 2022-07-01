<?php

use App\Controllers\MainController;
use App\Core\Route;

return [
    '/' => new Route(MainController::class, 'index'),
];