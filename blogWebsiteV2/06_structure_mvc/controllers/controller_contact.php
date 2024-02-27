<?php
$isDone = false;

if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {

    $email = htmlentities(strip_tags($_POST['email'])); 
    // htmlentitiestransformera en caractères alphanumériques, pour se protéger. tout ce qui n'est pas alphanumerique seront traité
    //strip_tags enlève les balises
    $password = htmlentities(strip_tags($_POST['password'])); 

    $password = password_hash($password, PASSWORD_DEFAULT);
    // fonction password hash d ephp => hache de mdp;
    //avec l'algorithme PASSWORD_DEFAULT;

    $errors = [];
    $exists = false;

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Veuillez renseigner une adresse email valide svp";
    }

    //Vérifier si l'email est dans la bdd
    // connexion à la bdd
    $db = connectDB();
    // on recherche si l'email est déjà dans la table user
    $query = $db->prepare("SELECT email FROM user WHERE email=:email"); 
    // bindParam permet de renseigner la requête afin de "protéger" le serveur SQL (contre injection)
    $query->bindParam(':email', $email);
    $query->execute();
    // fetchColumn cible un résultat uniquement (on ne veut qu'un seul résultat pour arrêter la requête)
    $exists = $query->fetchColumn(); //false si aucun résultat n'est trouvé ?
    // error si existe déjà dans la bdd
    if($exists){
        $errors[] = "Adresse email déjà utilisée";
    }
//     echo "<pre>";
// var_dump($adress1);
// echo "</pre>";
    // sil n'y a pas d'erreur on effectue l'insertion de l'utilisateur dans la bdd
    if (empty($errors)){
        $sql = $db->prepare("INSERT INTO USER (email, password) VALUES (:email, :password)");
        $sql->bindParam(':email', $email); //eviter de recevoir info directement du formulaire, enlève toutes les entités html pour les nettoyer
        $sql->bindParam(':password', $password); // ici on va le hasher !
        $sql->execute();
        // on récupère l'identifiant de la dernière ligne insérée;
        $user_id = $db->lastInsertID();

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
        $sql = $db->prepare("
        INSERT INTO CONTACT 
        (user_id, firstname, lastname, address1, address2, city, state, zip, message)
        VALUES 
        (:user_id, :firstname, :lastname, :address1, :address2, :city, :state, :zip, :message)");
        $sql->bindParam( ':user_id', $user_id );
        $sql->bindParam( ':firstname', $firstname);
        $sql->bindParam( ':lastname', $lastname);
        $sql->bindParam( ':address1', $address1);
        $sql->bindParam( ':address2', $address2);
        $sql->bindParam( ':city', $city);
        $sql->bindParam( ':state', $state);
        $sql->bindParam( ':zip', $zip);
        $sql->bindParam( ':message', $message);

        
        $sql->execute();

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
// on charge la vue
include "./views/base.phtml";
?>