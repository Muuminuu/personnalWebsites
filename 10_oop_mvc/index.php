<?php
namespace App;

use App\Services\Router;

require_once 'autoload.php'; 
require_once 'config.php';

$router = new Router();
$page = $router->getPage();

$controllerName = "App\Controllers\\".ucfirst($page)."Controller"; // upper case first letter // exemple : App\Controllers\HomeController
$controller = new $controllerName(); // on instancie la classe du controller // $controller = new HomeController() // nom du controller est généré dynamiquement
$controller->index();

