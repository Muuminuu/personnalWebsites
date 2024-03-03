<?php
// met dehors les ens pas admin
// if (!isset($_SESSION['user']['roles']) || !in_array("ROLE_ADMIN",json_decode($_SESSION['user']['roles']))){
//     header("Location:?page=home");
//     exit();
// }
//version avec function
if (!Utils::isRole("ROLE_ADMIN")){
    header("Location:?page=home");
    exit();
}
require_once('./models/Post.php');
// require_once('models/Contact.php');
// require_once('models/User.php');
// pour chercher les posts pour créer un peu un phpmyadmin userfriendly, pour l'admin.
$post = new Post;
$posts = $post->getAll(null);

// var_dump($_SESSION); 
// $id= $_SESSION['user']['id'];

// Tout le code qui suit ne SERT PAS !!!!!!!

// $user_obj = new User();
// $actual_user = $user_obj->getOne($id);


$db = Utils::connectDB();
$query = $db->prepare("SELECT * 
                        FROM user 
                        INNER JOIN contact 
                        ON user.id = contact.user_id
                        WHERE user.id=:id");  
$query->bindParam(':id', $id);
$query->execute();
$actual_user = $query->fetch(PDO::FETCH_ASSOC); 

// echo "<pre>";
// var_dump($actual_user);
// echo "</pre>";


include "./views/base.phtml";

?>