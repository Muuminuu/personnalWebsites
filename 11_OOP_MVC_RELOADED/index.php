<?php
namespace App;

use App\Services\Router;

require_once 'config.php';
require_once 'autoload.php'; 

session_start();

$router = new Router();
$page = $router->getPage();
$router->run();
