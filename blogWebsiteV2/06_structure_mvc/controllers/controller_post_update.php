<?php


if(!isset($_SESSION['user']['roles']) || !in_array('ROLE_ADMIN', json_decode($_SESSION['user']['roles']))){
    header("Location: ?page=home");
    exit;
}


$post_topic = $_GET['topic'];

echo "<pre>";
var_dump($post_topic);
echo "</pre>";

$db = connectDB();
$posts= [];
if ($db){
    $sql = $db->prepare("SELECT * FROM post ORDER BY id DESC");
    $sql->execute();
    $posts = $sql->fetch(PDO::FETCH_ASSOC);
}

// echo "<pre>";
// var_dump($posts);
// echo "</pre>";

// $db = connectDB();
// $sql = $db->prepare("SELECT * FROM article"); 
// // //$sql->bindParam(':id', $post_id);
// // // plutot utiliser un bind param
// $sql->execute();
// $the_post = $sql->fetch(PDO::FETCH_ASSOC);




if(isset($_POST['topic']) && isset($_POST['article']) && isset($_POST['image']) && !empty($_POST['topic']) && !empty($_POST['article']) && !empty($_POST['image']) )
{

//     $topic = htmlentities(strip_tags($_POST['topic']));
//     $article = htmlentities(strip_tags($_POST['article']));
//     $image = htmlentities(strip_tags($_POST['image']));


//     $sql = $db->prepare("UPDATE post SET title = :title, description = :description, image = :image WHERE post.id = $post_id");

//     $sql->bindParam(':title', $title);
//     $sql->bindParam(':description', $description);
//     $sql->bindParam(':image', $image);
//     $sql->execute();

//     header("Location: ?page=admin");

}



include "./views/base.phtml";
?>