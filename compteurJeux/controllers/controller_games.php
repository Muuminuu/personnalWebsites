<?php
// ma logique de controller
//;port=3306
// $db = Utils::connectDB();
// if($db){ // comprendre : si elle est vraie, true
//     $sql = $db->prepare("SELECT * FROM ??????? ORDER BY id LIMIT 3 "); // prepare requete
//     $sql->execute();//execute
//     $posts = $sql->fetchAll(PDO::FETCH_ASSOC);//retourne un tableau associatif
// }

// echo "<pre>";
// var_dump($posts);
// var_dump($_SESSION);
// echo "</pre>";

// on charge la vue
include "./views/base.phtml";
?>