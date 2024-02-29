<?php

if (!Utils::isRole("ROLE_ADMIN")){
    header("Location:?page=home");
    exit();
}
$id= $_SESSION['user']['id'];

$db = Utils::connectDB();
$query = $db->prepare("SELECT * 
                        FROM games ");  
$query->execute();
$games = $query->fetchAll(PDO::FETCH_ASSOC); 

Utils::dump($games);



include "./views/base.phtml";

?>