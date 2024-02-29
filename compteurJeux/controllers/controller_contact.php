<?php
$isDone = false;

if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {

    $email = htmlentities(strip_tags($_POST['email'])); 
    $password = htmlentities(strip_tags($_POST['password'])); 
    $password = password_hash($password, PASSWORD_DEFAULT);
    $errors = [];
    $exists = false;

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Veuillez renseigner une adresse email valide svp";
    }

    $db = Utils::connectDB();
    $query = $db->prepare("SELECT email FROM user WHERE email=:email"); 
    $query->bindParam(':email', $email);
    $query->execute();
    $exists = $query->fetchColumn(); 

    if($exists){
        $errors[] = "Adresse email déjà utilisée";
    }

    $role[] = "ROLE_MEMBER";
    $role = json_encode($role);

    if (empty($errors)){
        $sql = $db->prepare("INSERT INTO USER (email, password, roles) VALUES (:email, :password, :role)");

        $sql->bindParam(':email', $email); //eviter de recevoir info directement du formulaire, enlève toutes les entités html pour les nettoyer
        $sql->bindParam(':password', $password); // ici on va le hasher !
        $sql->bindParam(':role', $role);
        $sql->execute();
        // on récupère l'identifiant de la dernière ligne insérée;
        $user_id = $db->lastInsertID();

        $firstname = htmlentities(strip_tags($_POST['firstname']));
        $lastname = htmlentities(strip_tags($_POST['lastname']));
        $country = htmlentities(strip_tags($_POST['country']));
        $city = htmlentities(strip_tags($_POST['city']));
        $zip = htmlentities(strip_tags($_POST['zip']));
//décalage d'écriture entre adress1 dans bdd et address1, dans form et ce document.
// 
        $sql = $db->prepare("
        INSERT INTO user_detail 
        (user_id, firstname, lastname, country, city, zip)
        VALUES 
        (:user_id, :firstname, :lastname, :country, :city, :zip)");
        $sql->bindParam( ':user_id', $user_id );
        $sql->bindParam( ':firstname', $firstname);
        $sql->bindParam( ':lastname', $lastname);
        $sql->bindParam( ':country', $country);
        $sql->bindParam( ':city', $city);
        $sql->bindParam( ':zip', $zip);
        $sql->execute();
        $isDone = true;
    }      
}

include "./views/base.phtml";
?>