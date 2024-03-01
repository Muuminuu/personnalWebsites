<?php
namespace App\Controllers;

use App\Models\Post;

class HomeController{
    public function index(){
        $title = "Hello OOP world";
        $post = new Post();
        $posts = $post->getAll();
        $template = './views/template_home.phtml';
        $this->render($template,[$title,"posts"=>$posts]); // on va injecter nos variables dans ce tableau 
    }

    public function render($templatePath, $data){
        ob_start(); // ouvrir la mémoire tampon du serveur -> va mémorise ce qui suit.
        include $templatePath; // on charge la mémoire tampon dans le template.
        $template = ob_get_clean(); // nettoie la mémoire tampon;
        include './views/base.phtml';
    }
}