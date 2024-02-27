<?php


if(!isset($_SESSION['user']['roles']) || !in_array('ROLE_ADMIN', json_decode($_SESSION['user']['roles']))){
    header("Location: ?page=home");
    exit;
}

$id = htmlentities(strip_tags($_GET['id']));


// echo "<pre>";
// var_dump($id);
// echo "</pre>";

$db = connectDB();
$posts= [];
if ($db){
    $sql = $db->prepare("SELECT * FROM post ORDER BY id DESC");
    $sql->execute();
    $posts = $sql->fetch(PDO::FETCH_ASSOC);
}

$post_topic = $posts['topic'];
// echo "<pre>";
// var_dump($posts);
// echo "</pre>";


$db = connectDB();
if(isset($_POST['article']) && !empty($_POST['article'])){

    // $user_id =  $_SESSION['user']['id'];
    $article = htmlentities(strip_tags($_POST['article']));

    $sql = $db->prepare("
    INSERT INTO article
    (post_id, article)
    VALUES 
    (:post_id, :article)");

    $sql->bindParam( ':post_id', $id );
    $sql->bindParam( ':article', $article );
    $sql->execute();
}


////


$topics= [];
if ($db){
    $sql = $db->prepare("SELECT topic FROM post order by id desc");
    // $sql->bindParam(':id', $id);
    $sql->execute();
    $topics = $sql->fetchAll(PDO::FETCH_ASSOC);
}
$actual_topic=[];
if ($db){
    $sql = $db->prepare("SELECT topic FROM post where id = :id order by id desc");
    $sql->bindParam(':id', $id);
    $sql->execute();
    $actual_topic = $sql->fetch(PDO::FETCH_ASSOC);
}



// $topic_choice = $topics['topic'];

// echo "<pre>";
// var_dump($topics);
// echo "</pre>";
// $sql = $db->prepare("SELECT * FROM article inner join post on article.post_id = post.id where post.id = :id");
// $sql->bindParam(':id', $id);
// $sql->execute();
// $article_choice = $sql->fetchAll(PDO::FETCH_ASSOC);


// echo "<pre>";
// var_dump($article_choice['topic']);
// echo "</pre>";


$text_or_image = [
    'text',
    'image'
];

$text= 'text';
$image= 'image';

$existing_articles = [];
$db = connectDB();
$sql = $db->prepare("SELECT article FROM article where post_id = :id"); 
$sql->bindParam(':id', $id);
// // plutot utiliser un bind param
$sql->execute();
$existing_articles = $sql->fetchAll(PDO::FETCH_ASSOC);

// echo "<pre>";
// var_dump($existing_articles);
// echo "</pre>";








// envoyer url email vers bdd


// $image = htmlentities(strip_tags($_POST['image']));
// $image semble ne servir à rien;

if(isset($_POST['image']) && !empty($_POST['image'])){
    $sql = $db->prepare("
    INSERT INTO article
    (post_id, image)
    VALUES 
    (:post_id, :image)");

    $sql->bindParam( ':post_id', $id );
    $sql->bindParam( ':image', $image );
    $sql->execute();

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

echo "<pre>";
var_dump($actual_article);
var_dump($files_ordered);
echo "</pre>";


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