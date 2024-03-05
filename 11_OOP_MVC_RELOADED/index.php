<?php
namespace App;

use App\Services\Authenticator;
use App\Services\Router;

require_once 'config.php';
require_once 'autoload.php'; 

$auth = new Authenticator();
// session_start(); // remplacé par $auth

$router = new Router();
$page = $router->getPage();
$router->run();
