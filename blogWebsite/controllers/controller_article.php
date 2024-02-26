<?php
if ( !isset($_SESSION['user']) || !in_array("ROLE_ADMIN",json_decode($_SESSION['user']['roles'])) ){
    header("Location:?page=home");
    exit();
}

$this_topic = $_GET['topic'];
$this_topic = str_replace('-', ' ', $this_topic);
$db = connectDB();
$post = [];

// echo "<pre>";
// var_dump($this_topic);
// echo "</pre>";

if($db){ // comprendre : si elle est vraie, true
    $sql = $db->prepare("SELECT * FROM post WHERE :topic = topic"); // prepare requete
    $sql->bindParam(':topic', $this_topic);
    $sql->execute();//execute
    $post = $sql->fetchAll(PDO::FETCH_ASSOC);//retourne un tableau associatif
}
// echo "<pre>";
// var_dump($post);
// echo "</pre>";
$article_image = [];
if($db){ // comprendre : si elle est vraie, true
    $sql = $db->prepare("
    SELECT * FROM post 
    INNER JOIN article_image ON post.id = article_image.post_id 
    WHERE post.topic = :topic
"); // prepare requete
    $sql->bindParam(':topic', $this_topic);
    $sql->execute();//execute
    $article_image = $sql->fetchAll(PDO::FETCH_ASSOC);//retourne un tableau associatif
}
echo "<pre>";
var_dump($article_image);
echo "</pre>";
//


// if($db){
//         // On prépare la requête d'insertion pour la table de contact
//         $sql = $db->prepare("INSERT INTO contact (user_id, firstname, lastname, address1, address2, city, state, zip) VALUES(:user_id, :firstname, :lastname, :address1, :address2, :city, :state, :zip)");
//         $sql->bindParam(':user_id', $user_id, PDO::PARAM_INT);
//         $sql->bindParam(':firstname', $firstname);
//         $sql->bindParam(':lastname', $lastname);
     
//         $sql->execute();
        
     
// }
// on charge la vue
include "./views/base.phtml";
?>