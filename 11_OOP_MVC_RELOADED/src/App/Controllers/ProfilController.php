<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\UserManager;
use App\Models\ContactManager;
use App\Services\Authenticator;



class ProfilController extends AbstractController
{
    public function index()
    {

        if(!Authenticator::isRole("ROLE_ADMIN")){
            header('Location: ?page=home'); // sera login quand on aura une page admin ???
            exit();  }

        $id= $_SESSION['user']['id'];
                //////////////////////
        //                                  WIP 
        /////////////////////
        $a_u = new ContactManager();
        $user = $a_u->getAllBy("SELECT * FROM user 
        INNER JOIN contact ON user.id = contact.user_id 
        WHERE user.id=$id");

        $state = [ 
            "Auvergne-Rhône-Alpes",
            "Bourgogne-Franche-Comté",
            "Bretagne",
            "Centre-Val de Loire",
            "Corse",
            "Grand Est",
            "Hauts-de-France",
            "Ile-de-France",
            "Normandie",
            "Nouvelle-Aquitaine",
            "Occitanie",
            "Pays de la Loire",
            "Provence Alpes Côte d’Azur",
            "Guadeloupe",
            "Guyane",
            "Martinique",
            "Mayotte",
            "Réunion"
        ];
        
        
        var_dump($user);
        
        $template = './views/template_profil.phtml';
        $this->render($template, [
            'state' => $state,
            'user' => $user,

        ]);
        
        }
        public function profilUpdate (){
            $id= $_SESSION['user']['id'];
            $a_u = new ContactManager();
        $user = $a_u->getAllBy("SELECT * FROM user 
        INNER JOIN contact ON user.id = contact.user_id 
        WHERE user.id=$id");
            $user_id = $user['user_id'];
            $firstname = htmlentities(strip_tags($_POST['firstname']));
            $lastname = htmlentities(strip_tags($_POST['lastname']));
            $address1 = htmlentities(strip_tags($_POST['address1']));
            $address2 = htmlentities(strip_tags($_POST['address2']));
            $city = htmlentities(strip_tags($_POST['city']));
            $state = htmlentities(strip_tags($_POST['state']));
            $zip = htmlentities(strip_tags($_POST['zip']));      
            var_dump($firstname);
            // die();
            $u = new ContactManager();
            $u->updateAdam("UPDATE contact SET firstname = '$firstname', lastname = '$lastname', address1 = '$address1', address2 = '$address2', city = '$city', state = '$state', zip = '$zip' WHERE user_id = '$user_id'");


      
        $a_u = new ContactManager();
        $user = $a_u->getAllBy("SELECT * FROM user 
        INNER JOIN contact ON user.id = contact.user_id 
        WHERE user.id=$id");

        header ('Location: ?page=profil');
        }

    }
