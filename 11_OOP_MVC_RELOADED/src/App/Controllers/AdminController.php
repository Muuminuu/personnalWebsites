<?php
namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Services\Utils;

//gère la redirection si pas le role souhaité
class AdminController extends AbstractController {

    public function __construct() {
        if(!Utils::isRole("ROLE_ADMIN")){
            header('Location: ?page=home'); // sera login quand on aura une page admin ???
            die();
        }
        //des que le routeur fait un new controlle (router), ca fait cette fonction construct.
        //On ne veut pas que tous les controlleurs redirigent les gens. Seulement
    }
    public function index() {
        $template = './views/template_admin.phtml';
        $this->render($template, [
        'title' => 'Welcome to the Admin Dashboard',
        ]);
    }
    
}
