<?php

// met dehors les ens pas admin
if (!isset($_SESSION['user']['roles']) || !in_array("ROLE_ADMIN",json_decode($_SESSION['user']['roles']))){
    header("Location:?page=home");
    exit();
}

$id = $_GET['id'];



$db = Utils::connectDB();
$comments= [];


if ($db){

    $sql2 = $db->prepare("SELECT * FROM post WHERE id = :id");
    $sql2->bindParam(':id', $id);
    $sql2->execute();
    $post = $sql2->fetch(PDO::FETCH_ASSOC);
    


    $sql = $db->prepare("SELECT comments.*, contact.firstname, contact.lastname FROM comments INNER JOIN user ON comments.user_id = user.id INNER JOIN contact ON user.id = contact.user_id where comments.post_id = :id");
    $sql->bindParam(':id', $id);
    $sql->execute();
    $comments = $sql->fetchAll(PDO::FETCH_ASSOC);

    
}


include "./views/base.phtml";

?>