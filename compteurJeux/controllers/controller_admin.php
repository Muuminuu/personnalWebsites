<?php
// met dehors les ens pas admin
// if (!isset($_SESSION['user']['roles']) || !in_array("ROLE_ADMIN",json_decode($_SESSION['user']['roles']))){
//     header("Location:?page=home");
//     exit();
// }
//version avec function
if (!Utils::isRole("ROLE_ADMIN")){
    header("Location:?page=home");
    exit();
}


// pour chercher les posts pour créer un peu un phpmyadmin userfriendly, pour l'admin.
// $db = connectDB();
// $posts= [];
// if ($db){
//     $sql = $db->prepare("SELECT * FROM ????????? ORDER BY id DESC");
//     $sql->execute();
//     $posts = $sql->fetchAll(PDO::FETCH_ASSOC);
// }

// pour afficher le nom de l'admin connecté


// var_dump($_SESSION); 
$id= $_SESSION['user']['id'];

$db = Utils::connectDB();
$query = $db->prepare("SELECT * 
                        FROM user 
                        INNER JOIN user_detail 
                        ON user.id = user_detail.user_id
                        WHERE user.id=:id");  
$query->bindParam(':id', $id);
$query->execute();
$actual_user = $query->fetch(PDO::FETCH_ASSOC); 
// echo "<pre>";
// var_dump($actual_user);
// echo "</pre>";


include "./views/base.phtml";

?>