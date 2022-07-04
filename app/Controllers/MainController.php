<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\View;
use App\Models\Task;
use App\Models\User;

class MainController
{
    private View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function index(Request $request): string
    {
        $tasks = Task::all();
        return $this->view->render('tasks', [
            'tasks' => $tasks,
            'newTask' => $request->get('newTask') ?? false,
            'updateTask' => $request->get('updateTask') ?? false,
            'isAdmin' => $request->get('admin') ?? false,
        ]);
    }

    public function createTask(Request $request)
    {
        Task::create($request->get('user_name'), $request->get('email'), $request->get('task'));
        header('Location: /?newTask=true');
    }

    public function update(Request $request)
    {
        if ($request->get('admin')) {
            $task = Task::getById($request->get('id'));
            return $this->view->render('update', [
                'task' => $task[0],
            ]);
        } else {
            header('Location: /?error=true');
        }
    }

    public function updateTask(Request $request)
    {
        if ($request->get('admin')) {
            $status = $request->get('status') == 'on' ? 1 : 0;
            $fields = [
                'task' => $request->get('task'),
                'status' => $status
            ];
            $oldTask = Task::getTaskById($request->get('id'));
            if ($oldTask[0]->task != $request->get('task')) $fields['change_task'] = 1;
            Task::update($request->get('id'), $fields);
            header('Location: /?updateTask=true');
        } else {
            header('Location: /?error=true');
        }
    }

    public function login(Request $request)
    {
        return $this->view->render('auth', [
            'error' => $request->get('error') ?? false
        ]);
    }

    public function auth(Request $request)
    {
        $password = User::getPasswordByLogin($request->get('login'));
        if (count($password) == 0) {
            header('Location: /login?error=true', true);
        }
        if (password_verify($request->get('password'), $password[0]->password)) {
            setcookie('admin', true, time() + 3600, '/');
            header('Location: /');
        } else {
            header('Location: /login?error=true');
        }
    }

    public function logout()
    {
        setcookie('admin', false, -1, '/');
        header('Location: /');
    }
}