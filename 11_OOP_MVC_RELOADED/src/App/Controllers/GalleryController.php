<?php
namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\PostManager;
use App\Models\UserManager;


class GalleryController extends AbstractController{
    public function index(){
        $title = "Welcome to our Gallery";
        $dbPost = new PostManager();
        // requete pour tous les posts et nom/prenom auteur
        $posts = $dbPost->getAll(null,"SELECT post.*,contact.firstname,contact.lastname FROM post,contact WHERE post.user_id=contact.user_id ORDER BY id DESC");
        $dbUser = new UserManager();
        $users = $dbUser->getAll();
        
        $user_5 = $dbUser->getOneById(9); // test factice pour afficher user. //5 est faux comme valeur.
        //faire qqc de similaire pour le conntact mais pas avec cet id en brut.
        $user_5= $user_5['email'];

        $template = './views/template_gallery.phtml'; // mettre template_gallery ??????????????????
        $this->render($template,[
            'title'=>$title,
            'posts'=>$posts,
            'users'=>$users,
            'user_5'=>$user_5
        ]); // on va injecter nos variables dans ce tableau 







    }


    
}