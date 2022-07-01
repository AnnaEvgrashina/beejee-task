<?php

namespace App\Core;

class Route
{
    public string $controller;
    public string $action;

    public function __construct(string $controller, string $action)
    {
        $this->controller = $controller;
        $this->action = $action;
    }
}