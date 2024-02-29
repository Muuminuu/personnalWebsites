<?php
// met dehors les ens pas admin
if (!isset($_SESSION['user']['roles']) || !in_array("ROLE_ADMIN",json_decode($_SESSION['user']['roles']))){
    header("Location:?page=home");
    exit();
}

$id = htmlentities(strip_tags($_GET['id']));

$db = Utils::connectDB();
$user= [];
if ($db){
    $sql = $db->prepare("SELECT * FROM user,contact where user.id = :id");
    $sql->bindParam(':id', $id);
    $sql->execute();
    $user = $sql->fetch(PDO::FETCH_ASSOC);
}
$user_role = str_contains($user['roles'], 'ROLE_ADMIN');
if($user_role){
    $user_role = 'admin';
}else{
    $user_role = 'member';
}
Utils::dump($user_role);

Utils::dump($user);

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

include "./views/base.phtml";

?>