<?php
namespace App\Todolist;

use App\Todolist\TaskController;
use App\Todolist\HomeController;


class Router {

public function index() {
    $routes = [
    '/' => [
        'controller' => 'HomeController@index',
        'method' => 'GET'
    ],
    '/task' => [
        'controller' => 'TaskController@index',
        'method' => 'GET'
    ],
    '/task/new' => [
        'controller' => 'TaskController@new',
        // methode qui s'appellera new
        'method' => 'POST'
    ],
    '/task/:id' => [
        // bind dynamique :id
        'controller' => 'TaskController@show',
        'method' => 'GET'
    ],
    // '/task/delete/:id' => [
    //     'controller' => 'TaskController@delete',
    //     // methode qui s'appellera new
    //     'method' => 'POST'
    // ],

    ];

    $url = $_SERVER['REQUEST_URI'];
    if ($url === "/personnalWebsites/todo_list/public/") {
        $controller = new HomeController();
        $controller->index();
    }

    if ($url === "/personnalWebsites/todo_list/public/task/") {
        $controller = new TaskController();
        $controller->index();
    }
    if ($url === "/personnalWebsites/todo_list/public/task/new/") {
        $controller = new TaskController();
        $controller->new();
    }

    $parts = explode('/', $url);

    if (array_key_exists(5, $parts) && $parts[5]!=="" && (int)$parts[5] && $parts[4]==="task" && !$parts[6]) {
        $id = $parts[5];
        $controller = new TaskController();
        $controller->show($id);
    }

    if (array_key_exists(5, $parts) && $parts[5]!=="" && (int)$parts[5] && $parts[4]==="task" && $parts[6]==="update") {
        $id = $parts[5];
        $controller = new TaskController();
        $controller->update($id);
    }

    if (array_key_exists(5, $parts) && $parts[5]!=="" && (int)$parts[5] && $parts[4]==="task" && $parts[6]==="delete") {
        $id = $parts[5];
        $controller = new TaskController();
        $controller->delete($id);
    }
    
}

}