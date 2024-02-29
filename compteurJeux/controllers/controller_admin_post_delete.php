<?php 
//verification si admin
if (!isset($_SESSION['user']) || !in_array("ROLE_ADMIN",json_decode($_SESSION['user']['roles']))){
    header("Location:?page=home");
    exit();
}

$post_id = (int)$_GET['id'];
// echo "Attention suppression du post".$post_id;



$db = connectDB();
// $posts= [];
// $post est il nécessaire vu qu'existant dans autre page ?
if ($db){
    $sql = $db->prepare("DELETE FROM post
                         WHERE id=:id");
    $sql->bindParam(':id', $post_id);
    $sql->execute();
    header("Location:?page=admin");
    // $posts = $sql->fetchAll(PDO::FETCH_ASSOC);
}



?>