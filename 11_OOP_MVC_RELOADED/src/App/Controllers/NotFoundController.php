<?php
namespace App\Controllers;

use App\Models\Post;
use App\Controllers\AbstractController;

class NotFoundController extends AbstractController{
    public function index(){
        $title = "Page not found";
       
        // requete pour tous les posts et nom/prenom auteur
        $template = "./views/template_not_found.phtml";
        $this->render($template,['title'=>$title]); // on va injecter nos variables dans ce tableau 
    }

    
}