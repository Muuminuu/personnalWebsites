<?php
// ma logique de controller
// $db = Utils::connectDB();
// $posts = [];
// if ($db){
//    $sql = $db->prepare("SELECT ?????*,user_detail.firstname,user_detail.lastname FROM post,user_detail WHERE post.user_id=user_detail.user_id ORDER BY id DESC");
//    $sql->execute();
//    $posts = $sql->fetchAll(PDO::FETCH_ASSOC);
// }

// echo "<pre>" ;
// var_dump( $posts );
// echo "</pre>";
// on charge la vue
include "./views/base.phtml";
?>