<?php
namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\UserManager;
use App\Models\ContactManager;
use App\Services\Authenticator;


class ContactController extends AbstractController{
    public function index(){

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

        $isDone = false;
        $title = "Page contact";
        $ok_email = "";
        $errors = [];
        $email = "";
        if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {

            $email = htmlentities(strip_tags($_POST['email'])); 
            $password = htmlentities(strip_tags($_POST['password'])); 
            $password = password_hash($password, PASSWORD_DEFAULT);

            // $errors = [];
            $exists = false;

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors[] = "Veuillez renseigner une adresse email valide svp";
            }

            $user = new UserManager();
            $exists = $user->getUserByEmail($email);
            if($exists){
                $errors[] = "Adresse email déjà utilisée";
            }
            $role[] = "ROLE_MEMBER";
            $role = json_encode($role);

        if (empty($errors)){
            $user = new UserManager();
            $u=$user->insert([$email, $password, $role]);

            $user_id = $u->lastInsertId();

            $firstname = htmlentities(strip_tags($_POST['firstname']));
            $lastname = htmlentities(strip_tags($_POST['lastname']));
            $address1 = htmlentities(strip_tags($_POST['address1']));
            $address2 = htmlentities(strip_tags($_POST['address2']));

            $city = htmlentities(strip_tags($_POST['city']));
            $state = htmlentities(strip_tags($_POST['state']));
            $zip = htmlentities(strip_tags($_POST['zip']));
            $message = htmlentities(strip_tags($_POST['message']));
//décalage d'écriture entre adress1 dans bdd et address1, dans form et ce document.
// 
            $contact = new ContactManager();
            $contact->insert([$user_id, $firstname, $lastname,
            $address1, $address2, $city, $state, $zip, $message]);
            $isDone = true;
        }      
    }

    
        $existing_errors = true;
        $ok_email = true;
        $template = './views/template_contact.phtml';
        $this->render($template,[
            'title'=>$title, 
            'isDone'=>$isDone,
            'state'=>$state, 
            'email'=>$email, 
            'errors'=>$errors,
            'existing_errors'=>$existing_errors,
            'ok_email'=>$ok_email]); // on va injecter nos variables dans ce tableau 
    }

}