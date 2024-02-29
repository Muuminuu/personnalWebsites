<?php

if (!isset($_SESSION['user']['roles']) || !in_array("ROLE_MEMBER",json_decode($_SESSION['user']['roles']))){
    header("Location:?page=home");
    exit();
}
// ici j'ai changé role admin par role member ? est suffisant ? ne faut il pas automatiquement ajouter le role member 
//lors d ela creation du compte ?
$id= $_SESSION['user']['id'];


$db = Utils::connectDB();
if($db){
    $query = $db->prepare("SELECT * FROM user INNER JOIN user_detail ON user.id = user_detail.user_id WHERE user.id=:id");  
    $query->bindParam(':id', $id);
    $query->execute();
    $actual_user = $query->fetch(PDO::FETCH_ASSOC); 
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


function profilUpdate (){
    $firstname = htmlentities(strip_tags($_POST['firstname']));
    $lastname = htmlentities(strip_tags($_POST['lastname']));
    $country = htmlentities(strip_tags($_POST['country']));
    $email = htmlentities(strip_tags($_POST['email']));
    $city = htmlentities(strip_tags($_POST['city']));
    $zip = htmlentities(strip_tags($_POST['zip']));

    $db=Utils::connectDB();
    $user_id = $_SESSION['user']['id'];
    $sql = $db->prepare("UPDATE user SET email=:email WHERE id=:id");
    $sql->bindParam(':email', $email);
    $sql->bindParam(':id', $user_id);
    $sql->execute();

// $db=connectDB();
// $user_id = $_SESSION['user']['id'];
    $sql = $db->prepare("
    UPDATE user_detail 
    set 
    firstname = :firstname,
    lastname = :lastname,
    country = :country,
    city = :city,
    zip = :zip
    WHERE user_id = :user_id
    ");
    $sql->bindParam( ':user_id', $user_id );
    $sql->bindParam( ':firstname', $firstname);
    $sql->bindParam( ':lastname', $lastname);
    $sql->bindParam( ':country', $country);
    $sql->bindParam( ':city', $city);
    $sql->bindParam( ':zip', $zip);


    
    $sql->execute();
    $id= $_SESSION['user']['id'];
    $query = $db->prepare("SELECT * FROM user INNER JOIN user_detail ON user.id = user_detail.user_id WHERE user.id=:id");  
    $query->bindParam(':id', $id);
    $query->execute();
    $actual_user = $query->fetch(PDO::FETCH_ASSOC); 
    // echo "<pre>";
    // var_dump($_SESSION['user']);
    // var_dump($user_id);
    // var_dump($actual_user);
    // echo "</pre>";
    return $actual_user;


} ;

if (isset($_POST['submit'])){
    $actual_user = profilUpdate();
}



include "./views/base.phtml";

?>