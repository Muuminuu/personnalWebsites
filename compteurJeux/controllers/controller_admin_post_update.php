<?php


if(!isset($_SESSION['user']['roles']) || !in_array('ROLE_ADMIN', json_decode($_SESSION['user']['roles']))){
    header("Location: ?page=home");
    exit;
}




$post_id = (int)$_GET['id']; // transtypage, pour paser d'un type à un autre
$db = Utils::connectDB();
$sql = $db->prepare("SELECT * FROM post WHERE id=$post_id"); 
//$sql->bindParam(':id', $post_id);
// plutot utiliser un bind param
$sql->execute();
$the_post = $sql->fetch(PDO::FETCH_ASSOC);




if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['image']) && !empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['image']) )
{

    $title = htmlentities(strip_tags($_POST['title']));
    $description = htmlentities(strip_tags($_POST['description']));
    $image = htmlentities(strip_tags($_POST['image']));


    $sql = $db->prepare("UPDATE post SET title = :title, description = :description, image = :image WHERE post.id = $post_id");

    $sql->bindParam(':title', $title);
    $sql->bindParam(':description', $description);
    $sql->bindParam(':image', $image);
    $sql->execute();

    header("Location: ?page=admin");

}



include "./views/base.phtml";
?>