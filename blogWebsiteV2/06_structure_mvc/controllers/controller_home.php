<?php
// ma logique de controller
//;port=3306
// 
require_once("./models/Post.php");
// singulier
$post =new Post();
$posts = $post->getAll(3);


// on charge la vue
include "./views/base.phtml";
?>