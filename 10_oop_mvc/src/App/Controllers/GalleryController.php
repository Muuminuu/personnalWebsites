<?php
namespace App\Controllers;

use App\Models\Post;

class GalleryController{
    public function index(){
        $title = "Welcome to our Gallery";
        $post = new Post();
        // requete pour tous les posts et nom/prenom auteur
        $posts = $post->getAll(null,"SELECT post.*,contact.firstname,contact.lastname FROM post,contact WHERE post.user_id=contact.user_id ORDER BY id DESC");
        $template = './views/template_gallery.phtml'; // mettre template_gallery ??????????????????
        $this->render($template,['title'=>$title,'posts'=>$posts]); // on va injecter nos variables dans ce tableau 
    }

    public function render($templatePath, $data){
        ob_start(); // ouvrir la mémoire tampon du serveur -> va mémorise ce qui suit.
        include $templatePath; // on charge la mémoire tampon dans le template.
        $template = ob_get_clean(); // nettoie la mémoire tampon;
        include './views/base.phtml';
    }
}