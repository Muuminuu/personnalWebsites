<?php 
// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";
var_dump($_SESSION['user']['id']);
if(!isset($_SESSION['user']['roles']) || !in_array('ROLE_ADMIN', json_decode($_SESSION['user']['roles']))){
    header("Location: ?page=home");
    exit;
}

if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['image']) && isset($_POST['topic']) 
// && 
// !empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['image'])
 )
{

    $title = htmlentities(strip_tags($_POST['title']));
    $description = htmlentities(strip_tags($_POST['description']));
    $image = htmlentities(strip_tags($_POST['image']));
    $topic = htmlentities(strip_tags($_POST['topic']));

    var_dump($title, $description, $image);
    
    $db = Utils::connectDB();
    $sql = $db->prepare("INSERT INTO post (user_id, title, topic, description, image) VALUES
    (:user_id, :title, :topic, :description, :image)");

    $sql->bindParam(':user_id', $_SESSION['user']['id']);
    // on ne fait pas le htmlentities et strip_tags car cette info ne vient pas d'un formulaire mais de l'utilisateur connecté.
    $sql->bindParam(':title', $title);
    $sql->bindParam(':topic', $topic);
    $sql->bindParam(':description', $description);
    $sql->bindParam(':image', $image);
    $sql->execute();

    header("Location: ?page=admin");
}

include "./views/base.phtml";
?>













