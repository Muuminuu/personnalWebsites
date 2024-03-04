<?php

// c'est une classe abstraite car on ne va jamais l'intancier directement
namespace App\Controllers;

abstract class AbstractController{
    // This is a common method to display template and send come data
    protected function render($templatePath, $data){
        // 
        ob_start(); // ouvrir la mémoire tampon du serveur -> va mémorise ce qui suit.
        extract($data);
                // $data['posts'] = $posts -> extract($data) permet de récupérer directemeent $ posts dans la vue.;
        include $templatePath; // on charge la mémoire tampon dans le template.
        $template = ob_get_clean(); // nettoie la mémoire tampon;
        include './views/base.phtml';
    }
}
