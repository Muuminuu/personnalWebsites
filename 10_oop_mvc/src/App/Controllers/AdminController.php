<?php
namespace App\Controllers;

use App\Models\Contact;
use App\Models\Post;
use App\Models\User;
use App\Services\Utils;


class AdminController{
    public function index(){
        $title = "Hello OOP world";
    
        if (!Utils::isRole("ROLE_ADMIN")){
            header("Location:?page=home");
            exit();
        }
        //process pour recupérer info du contact connecté -> dans template_appeler $user['firstname']
        $id = $_SESSION['user']['id'];
        $u = new User();
        $user = $u->getOne(null,"SELECT * FROM user INNER  JOIN contact ON user.id = contact.user_id WHERE user.id=$id");

        $post = new Post();
        $posts = $post->getAll();
        $template = './views/template_admin.phtml';
        $this->render($template,['title'=>$title,'posts'=>$posts,'user'=>$user]); // on va injecter nos variables dans ce tableau 
    }

    public function render($templatePath, $data){
        ob_start(); // ouvrir la mémoire tampon du serveur -> va mémorise ce qui suit.
        include $templatePath; // on charge la mémoire tampon dans le template.
        $template = ob_get_clean(); // nettoie la mémoire tampon;
        include './views/base.phtml';
    }
}