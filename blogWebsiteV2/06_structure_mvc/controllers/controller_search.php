<?php
// ma logique de controller
require_once('./models/Post.php');
// $db = Utils::connectDB();

$keywords = strip_tags(urldecode(trim($_GET['keywords'])));
$posts = [];

$post = new Post();
$posts = $post->getAll(null,"SELECT * FROM post WHERE title LIKE '%".$keywords."%' OR description LIKE '%".$keywords."%' OR image LIKE '%".$keywords."%' ORDER BY id");
//trim pour enlever espaces avant et apres / urldecode pour comprendre les caractères speciaux /
//strig_tags pour enlever balise et proteger contre code malicieux


// if($db){ // comprendre : si elle est vraie, true
//     $sql = $db->prepare("
//         SELECT * 
//         FROM post 
//         WHERE title 
//         LIKE '%".$keywords."%' OR description LIKE '%".$keywords."%' OR image LIKE '%".$keywords."%'
//         ORDER BY id"); // prepare requete
//     $sql->execute();//execute
//     $posts = $sql->fetchAll(PDO::FETCH_ASSOC);
//     //retourne un tableau associatif
// }
// on charge la vue
include "./views/base.phtml";
?>