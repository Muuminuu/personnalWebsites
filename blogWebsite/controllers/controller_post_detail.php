<?php

if (!isset($_SESSION['user']['roles']) || !in_array("ROLE_ADMIN",json_decode($_SESSION['user']['roles']))){
    header("Location:?page=home");
    exit();
}
// ma logique de controller
$id = htmlentities(strip_tags($_GET['id']));

// echo "<pre>";
// var_dump($comment);
// echo "</pre>";

$db = connectDB();
$post = [];
if ($db){
   $sql = $db->prepare("SELECT post.*,contact.firstname,contact.lastname FROM post,contact WHERE post.user_id=contact.user_id AND post.id=:id ORDER BY id DESC");
   $sql->bindParam(':id', $id);
   $sql->execute();
   // echo "<pre>";
   $post = $sql->fetch(PDO::FETCH_ASSOC);
   // var_dump( $posts );
}

$db = connectDB();
if(isset($_POST['comment']) && !empty($_POST['comment'])){
    $user_id =  $_SESSION['user']['id'];
    $comment = htmlentities(strip_tags($_POST['comment']));
    $sql = $db->prepare("
    INSERT INTO comments 
    (post_id, user_id, comments)
    VALUES 
    (:post_id, :user_id, :comment)");
    $sql->bindParam( ':user_id', $user_id);
    $sql->bindParam( ':post_id', $id );
    $sql->bindParam( ':comment', $comment );
    $sql->execute();
    $commentaire = $sql->fetch(PDO::FETCH_ASSOC);
}

$existing_comments = [];
if ($db){
   $sql = $db->prepare("SELECT comments.*, contact.firstname, contact.lastname
                        FROM comments
                        INNER JOIN user ON user.id=comments.user_id
                        INNER JOIN post ON post.id=comments.post_id
                        INNER JOIN contact ON contact.user_id=user.id
                        HAVING post_id = :id
                        ORDER BY comments.id");
   $sql->bindParam(':id', $id);
   $sql->execute();
   // echo "<pre>";
   $existing_comments = $sql->fetchAll(PDO::FETCH_ASSOC);
   // var_dump( $posts );
}
//OUIIIIIIIIIIIIIIIIII CA PUTAIN DE MAAAAAAAAAARCHE

// echo "<pre>";
// var_dump($comment);
// echo "</pre>";


// on charge la vue
include "./views/base.phtml";
