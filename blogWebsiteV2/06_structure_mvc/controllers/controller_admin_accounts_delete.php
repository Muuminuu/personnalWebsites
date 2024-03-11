<?php 
//verification si admin
if (!isset($_SESSION['user']) || !in_array("ROLE_ADMIN",json_decode($_SESSION['user']['roles']))){
    header("Location:?page=home");
    exit();
}

$id = (int)$_GET['id'];
// echo "Attention suppression du post".$post_id;



$db = Utils::connectDB();
// $posts= [];
// $post est il nécessaire vu qu'existant dans autre page ?
if ($db){

    $sql2 = $db->prepare("DELETE FROM contact
                         WHERE user_id=:id");    
    $sql2->bindParam(':id', $id);    
    $sql2->execute();

    $sql = $db->prepare("DELETE FROM user
                         WHERE id=:id");
    $sql->bindParam(':id', $id);
    $sql->execute();
    // header("Location:?page=admin_accounts");
    // $posts = $sql->fetchAll(PDO::FETCH_ASSOC);


   

    header("Location:?page=admin_accounts");
}



?>