<?php 
//verification si admin
if (!isset($_SESSION['user']) || !in_array("ROLE_ADMIN",json_decode($_SESSION['user']['roles']))){
    header("Location:?page=home");
    exit();
}

$id = (int)$_GET['id'];
$article_id = (int)$_GET['file_id'];
var_dump($article_id);
// echo "Attention suppression du post".$post_id;



$db = Utils::connectDB();
// $posts= [];
// $post est il nécessaire vu qu'existant dans autre page ?
if ($db){
    $sql = $db->prepare("DELETE FROM article
                        WHERE id=:id");
    $sql->bindParam(':id', $article_id);
    $sql->execute();
    header("Location:?page=post_update&id=$id");
    // $posts = $sql->fetchAll(PDO::FETCH_ASSOC);
}



?>