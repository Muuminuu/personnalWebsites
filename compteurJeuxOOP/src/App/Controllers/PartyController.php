<?php
namespace App\Controllers;

use App\Models\Party;

class PartyController{
    public function index(){
        $title = "Let's play !";
        $players = htmlentities(strip_tags($_GET['players']));
        // $party = new Party();
        // $parties = $party->getAll();
        $template = './views/template_admin.phtml';
        $this->render($template,['title'=>$title,'players'=>$players]); // on va injecter nos variables dans ce tableau 
    }

    public function render($templatePath, $data){
        ob_start(); // ouvrir la mémoire tampon du serveur -> va mémorise ce qui suit.
        include $templatePath; // on charge la mémoire tampon dans le template.
        $template = ob_get_clean(); // nettoie la mémoire tampon;
        include './views/base.phtml';
    }
}