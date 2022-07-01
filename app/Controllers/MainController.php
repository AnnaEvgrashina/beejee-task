<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\View;
use App\Models\Task;

class MainController
{
    private View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function index(Request $request): string
    {
        $tasks = Task::all($request->get('sort'), $request->get('direction'), $request->get('page'));
        return $this->view->render('tasks', [
            'tasks' => $tasks
        ]);
    }
}