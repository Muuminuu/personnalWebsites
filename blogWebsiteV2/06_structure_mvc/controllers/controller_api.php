<?php
require_once('./models/Post.php');
// $db = Utils::connectDB();
$post = new Post();
$posts = $post->getAll(null, "SELECT post.*,contact.firstname,contact.lastname FROM post,contact WHERE post.user_id=contact.user_id ORDER BY id DESC");



// if ($db){
//    $sql = $db->prepare("SELECT post.*,contact.firstname,contact.lastname FROM post,contact WHERE post.user_id=contact.user_id ORDER BY id DESC");
//    $sql->execute();
//    // echo "<pre>";
//    $posts = $sql->fetchAll(PDO::FETCH_ASSOC);
//    // var_dump( $posts );
// }

header('content-type: application/json');

// echo "<pre>" ;
echo json_encode( $posts );
// echo "</pre>";


?>