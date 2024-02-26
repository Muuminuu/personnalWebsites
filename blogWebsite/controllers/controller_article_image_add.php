<?php

if ( !isset($_SESSION['user']) || !in_array("ROLE_ADMIN",json_decode($_SESSION['user']['roles'])) ){
    header("Location:?page=home");
    exit();
}

// $post_id = (int)$_GET['id'];



if($db){
    // On prépare la requête d'insertionpour la table de contact
    $sql = $db->prepare("INSERT INTO article_image (user_id, topic, number,image) VALUES(:user_id, :topic,:number, :image)");
    $sql->bindParam(':user_id', $post_id,PDO::PARAM_INT);
    $sql->bindParam(':topic', $topic);
    $sql->bindParam(':number', $number);
    $sql->bindParam(':image', $image);
     
    $sql->execute();
        
    header("Location:?page=admin");
}

?>