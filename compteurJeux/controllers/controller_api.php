<?php

$db = connectDB();
$posts = [];
if ($db){
   $sql = $db->prepare("SELECT post.*,contact.firstname,contact.lastname FROM post,contact WHERE post.user_id=contact.user_id ORDER BY id DESC");
   $sql->execute();
   // echo "<pre>";
   $posts = $sql->fetchAll(PDO::FETCH_ASSOC);
   // var_dump( $posts );
}

header('content-type: application/json');

// echo "<pre>" ;
echo json_encode( $posts );
// echo "</pre>";


?>