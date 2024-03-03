<?php
namespace App\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Services\Utils;

class HomeController{
    public function index(){
        $title = "Hello OOP world";
        $post = new Post();
        $posts = $post->getAll();

        if (Utils::isRole("ROLE_MEMBER")) {
     
        $id = $_SESSION['user']['id'];
        $u = new User();
        $user = $u->getOne(null,"SELECT * FROM user INNER  JOIN contact ON user.id = contact.user_id WHERE user.id=$id");

        $u_firstname = $user['firstname'];
        $u_lastname = $user['lastname'];
        $member = true;
        $template = './views/template_home.phtml';
        $this->render($template,["title"=>$title,"posts"=>$posts,'u_firstname'=>$u_firstname,'u_lastname'=>$u_lastname,'member'=>$member]); // on va injecter nos variables dans ce tableau 
   
        }
        else{

            $title = "Hello OOP world";
        $post = new Post();
        $posts = $post->getAll();
        $member = false;
        $template = './views/template_home.phtml';
        $this->render($template,["title"=>$title,"posts"=>$posts,'member'=>$member]); // on va injecter nos variables dans ce tableau 
        }
        
        
    }

    public function render($templatePath, $data){
        ob_start(); // ouvrir la mémoire tampon du serveur -> va mémorise ce qui suit.
        include $templatePath; // on charge la mémoire tampon dans le template.
        $template = ob_get_clean(); // nettoie la mémoire tampon;
        include './views/base.phtml';
    }
}