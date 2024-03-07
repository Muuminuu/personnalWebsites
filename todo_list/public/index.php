<?php
// exemples de routes
require_once '../vendor/autoload.php';

use App\Todolist\Router;

require_once '../src/Router.php';

$router = new Router();
$router->index();
