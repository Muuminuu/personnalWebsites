<?php

if (!isRole("ROLE_ADMIN")){
    header("Location:?page=home");
    exit();
}
$id= $_SESSION['user']['id'];

$db = connectDB();
$query = $db->prepare("SELECT * 
                        FROM games ");  
$query->execute();
$games = $query->fetchAll(PDO::FETCH_ASSOC); 

dump($games);



include "./views/base.phtml";

?>