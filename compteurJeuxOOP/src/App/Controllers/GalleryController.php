<?php
namespace App\Controllers;

use App\Models\Post;

class GalleryController{
    public function index(){
        $title = "Hello this is the GalleryController";
        $post = new Post();
        $posts = $post->getAll();
        $template = './views/template_gallery.phtml'; // mettre template_gallery ??????????????????
        $this->render($template,[$title],$posts); // on va injecter nos variables dans ce tableau 
    }

    public function render($templatePath, $data, $posts){
        ob_start(); // ouvrir la mémoire tampon du serveur -> va mémorise ce qui suit.
        include $templatePath; // on charge la mémoire tampon dans le template.
        $template = ob_get_clean(); // nettoie la mémoire tampon;
        include './views/base.phtml';
    }
}