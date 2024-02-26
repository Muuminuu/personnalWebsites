<?php
// ma logique de controller
$db = connectDB();
$posts = [];
// if ($db){
//    $sql = $db->prepare("SELECT post.*,contact.firstname,contact.lastname FROM post,contact WHERE post.user_id=contact.user_id ORDER BY id DESC");
//    $sql->execute();
//    // echo "<pre>";
//    $posts = $sql->fetchAll(PDO::FETCH_ASSOC);
//    // var_dump( $posts );
// }

if ($db){
   $sql = $db->prepare("SELECT post.*,contact.firstname,contact.lastname FROM post,contact WHERE post.user_id=contact.user_id ORDER BY id DESC");
   $sql->execute();
   // echo "<pre>";
   $posts = $sql->fetchAll(PDO::FETCH_ASSOC);
   // var_dump( $posts );
}

// echo "<pre>" ;
// var_dump( $posts );
// echo "</pre>";
// on charge la vue
include "./views/base.phtml";
?>