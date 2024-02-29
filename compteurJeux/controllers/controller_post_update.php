<!-- <script>
    function tarace(){
        alert('test');
    }
</script> -->
<?php

if(!isset($_SESSION['user']['roles']) || !in_array('ROLE_ADMIN', json_decode($_SESSION['user']['roles']))){
    header("Location: ?page=home");
    exit;
}

$id = htmlentities(strip_tags($_GET['id']));
$db = Utils::connectDB();
if(isset($_GET['id_file'])){
    $id_file = htmlentities(strip_tags($_GET['id_file']));
    $sql = $db->prepare("SELECT * FROM article where id = :id");
    $sql->bindParam(':id', $id_file);
    $sql->execute();
    $fileEdit = $sql->fetch(PDO::FETCH_ASSOC);
}

if(isset($_POST['article']) && !empty($_POST['article']) && !isset($_GET['id_file'])){

    // $user_id =  $_SESSION['user']['id'];
    $article = htmlentities(strip_tags($_POST['article']));
    $position = $_POST['position'];
    $sql = $db->prepare(" INSERT INTO article (post_id, article, position) VALUES (:post_id, :article, :position)");
    $sql->bindParam( ':post_id', $id );
    $sql->bindParam( ':article', $article );
    $sql->bindParam( ':position', $position );
    $sql->execute();
}

if(isset($_POST['article']) && !empty($_POST['article']) && isset($_GET['id_file'])){

    // $user_id =  $_SESSION['user']['id'];
    $article = htmlentities(strip_tags($_POST['article']));
    $position = $_POST['position'];
    $sql = $db->prepare(" UPDATE article SET article = :article, image = '', position = :position WHERE id = :id");
    $sql->bindParam( ':id', $id_file );
    $sql->bindParam( ':article', $article );
    $sql->bindParam( ':position', $position );
    $sql->execute();
    header("Location: ?page=post_update&id=$id");
}
// $topics= [];
// if ($db){
//     $sql = $db->prepare("SELECT topic FROM post order by id desc");
//     // $sql->bindParam(':id', $id);
//     $sql->execute();
//     $topics = $sql->fetchAll(PDO::FETCH_ASSOC);
// }
// $actual_topic=[];
// if ($db){
//     $sql = $db->prepare("SELECT topic FROM post where id = :id order by id desc");
//     $sql->bindParam(':id', $id);
//     $sql->execute();
//     $actual_topic = $sql->fetch(PDO::FETCH_ASSOC);
// }

$existing_articles = [];
$db = Utils::connectDB();
$sql = $db->prepare("SELECT article FROM article where post_id = :id"); 
$sql->bindParam(':id', $id);
// // plutot utiliser un bind param
$sql->execute();
$existing_articles = $sql->fetchAll(PDO::FETCH_ASSOC);

// echo "<pre>";
// var_dump($existing_articles);
// echo "</pre>";


if(isset($_POST['image']) && !empty($_POST['image']) && !isset($_GET['id_file'])){
    $image = htmlentities(strip_tags($_POST['image']));
    $position = $_POST['position'];
    $sql = $db->prepare(" INSERT INTO article (post_id, image, position) VALUES (:post_id, :image, :position)");
    $sql->bindParam( ':post_id', $id );
    $sql->bindParam( ':image', $image );
    $sql->bindParam( ':position', $position );
    $sql->execute();

}
if(isset($_POST['image']) && !empty($_POST['image']) && isset($_GET['id_file'])){
    $image = htmlentities(strip_tags($_POST['image']));
    $position = $_POST['position'];
    $sql = $db-> prepare ("UPDATE article SET image = :image, article = '', position = :position WHERE id = :id");
    $sql->bindParam( ':image', $image );
    $sql->bindParam( ':id', $id_file );
    $sql->bindParam( ':position', $position );
    $sql->execute();
    header("Location: ?page=post_update&id=$id");
}

// recupérer url bdd
$existing_images = [];

$sql = $db->prepare("SELECT image FROM article where post_id = :id"); 
$sql->bindParam(':id', $id);
// // plutot utiliser un bind param
$sql->execute();
$existing_images = $sql->fetchAll(PDO::FETCH_ASSOC);


$files_ordered = [];

$sql = $db->prepare("SELECT article,image,position,id FROM article where post_id = :id order by position");
$sql->bindParam(':id', $id);
$sql->execute();
$files_ordered = $sql->fetchAll(PDO::FETCH_ASSOC);

$value="";

$actual_article = [];
$sql = $db->prepare("SELECT article FROM article where post_id = :id order by position");
$sql->bindParam(':id', $id);
$sql->execute();
$actual_article = $sql->fetch(PDO::FETCH_ASSOC);

$actual_article_value = $actual_article['article'];

// echo "<pre>";
// var_dump($actual_article);
// var_dump($files_ordered);
// echo "</pre>";


// if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['image']) && !empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['image']) )
// {

    // $title = htmlentities(strip_tags($_POST['title']));
    // $description = htmlentities(strip_tags($_POST['description']));
    // $image = htmlentities(strip_tags($_POST['image']));


    // $sql = $db->prepare("UPDATE article SET title = :title, description = :description, image = :image WHERE post.id = $post_id");

    // $sql->bindParam(':title', $title);
    // $sql->bindParam(':description', $description);
    // $sql->bindParam(':image', $image);
    // $sql->execute();

    // header("Location: ?page=admin");

// }









include "./views/base.phtml";
?>