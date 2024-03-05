<?php
namespace App\Controllers;

use App\Models\UserManager;

use App\Controllers\AbstractController;
use App\Services\Authenticator;

class AdminAccountsController extends AbstractController 
{
    public function __construct() {
        if(!Authenticator::isRole("ROLE_ADMIN")){
            header('Location: ?page=home'); // sera login quand on aura une page admin ???
            die();
        }
        //des que le routeur fait un new controlle (router), ca fait cette fonction construct.
        //On ne veut pas que tous les controlleurs redirigent les gens. Seulement
    }
    public function index() {
        $u = new UserManager();
        $users = $u->getAll();

        $template = './views/template_admin_accounts.phtml';
        $this->render($template, [
        'title' => 'Welcome to the Admin Dashboard',
        'users' => $users,
        ]);
    }
}