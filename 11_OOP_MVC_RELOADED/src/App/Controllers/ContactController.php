<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Contact;
use App\Services\Utils;

class ContactController{
    public function index(){

        $isDone = false;
        $title = "Page contact";
        $ok_email = "";
        $errors = [];
        $email = "";
if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {

    $email = htmlentities(strip_tags($_POST['email'])); 
    $password = htmlentities(strip_tags($_POST['password'])); 
    $password = password_hash($password, PASSWORD_DEFAULT);

    $errors = [];
    $exists = false;

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Veuillez renseigner une adresse email valide svp";
    }
    $user = new User();
    $exists = $user->getOne(null,"SELECT * FROM user WHERE email = '$email'");

    if($exists){
        $errors[] = "Adresse email déjà utilisée";
    }
    $role[] = "ROLE_MEMBER";
    $role = json_encode($role);

    if (empty($errors)){
        $user = new User();
        $u=$user->insertUser($email, $password, $role);

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
$contact = new Contact();
$contact->insertContact($user_id, $firstname, $lastname,
$address1, $address2, $city, $state, $zip, $message);


        $isDone = true;
    }      
}

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
            $existing_errors = true;
            $ok_email = true;
            $template = './views/template_contact.phtml';
            $this->render($template,['title'=>$title, 'isDone'=>$isDone,'state'=>$state, 'email'=>$email, 'errors'=>$errors,'existing_errors'=>$existing_errors,'ok_email'=>$ok_email]); // on va injecter nos variables dans ce tableau 
    }

    public function render($templatePath, $data){
        ob_start(); // ouvrir la mémoire tampon du serveur -> va mémorise ce qui suit.
        extract($data);
        include $templatePath; // on charge la mémoire tampon dans le template.
        $template = ob_get_clean(); // nettoie la mémoire tampon;
        include './Views/base.phtml';
    }
}