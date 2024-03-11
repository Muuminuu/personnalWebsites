<?php 
//verification si admin
if (!isset($_SESSION['user']) || !in_array("ROLE_ADMIN",json_decode($_SESSION['user']['roles']))){
    header("Location:?page=home");
    exit();
}

$post_id = (int)$_GET['id']; //23



// echo "Attention suppression du post".$post_id;
    // $sql = $db->prepare("SELECT * FROM post
    //                     WHERE id=:id");
    // $sql->bindParam(':id', $id);
    // $comments = $sql->execute();
    // var_dump($comments);
    // die();
    $comment_id = $_GET['comment_id'];
// $comment_id = $_GET['comment_id'];

$db = Utils::connectDB();
// $posts= [];
// $post est il nécessaire vu qu'existant dans autre page ?
if ($db){

    $sql2 = $db->prepare("DELETE FROM comments
                        WHERE id=:id");    
    $sql2->bindParam(':id', $comment_id);    
    $test=$sql2->execute();

    header("Location:?page=admin_comments&id=$post_id");

}



?>
