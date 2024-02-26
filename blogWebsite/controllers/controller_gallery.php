<?php
// ma logique de controller
$db = connectDB();
$posts = [];
if($db){ // comprendre : si elle est vraie, true
    $sql = $db->prepare("SELECT * FROM post ORDER BY id"); // prepare requete
    $sql->execute();//execute
    $posts = $sql->fetchAll(PDO::FETCH_ASSOC);//retourne un tableau associatif
}

$exists = [];
// on charge la vue
include "./views/base.phtml";
?>