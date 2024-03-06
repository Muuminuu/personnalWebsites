<?php
namespace App\Controllers;

use App\Services\Utils;
use App\Models\PostManager;
use App\Models\ArticleManager;
use App\Models\CommentsManager;

use App\Models\UserManager;
use App\Services\Authenticator;
use App\Controllers\AbstractController;

class PostArticleUpdateController extends AbstractController{
    public function __construct() {
        if(!Authenticator::isRole("ROLE_ADMIN")){
            header('Location: ?page=home'); // sera login quand on aura une page admin ???
            die();
        }
        //des que le routeur fait un new controlle (router), ca fait cette fonction construct.
        //On ne veut pas que tous les controlleurs redirigent les gens. Seulement
    }

    public function index() {

        $p = new PostManager();
        $posts = $p->getAll();
        $a = new ArticleManager();
        $articles = $a->getAll();


// require_once
        if(!Authenticator::isRole("ROLE_ADMIN")){
            header('Location: ?page=home'); // sera login quand on aura une page admin ???
            die();
        }


        $id = htmlentities(strip_tags($_GET['id']));

        $f_e = new ArticleManager();
        $file_edit = $f_e->getOneById($id);
var_dump($file_edit);

// $db = Utils::connectDB();
// if(isset($_GET['id_file'])){
//     $id_file = htmlentities(strip_tags($_GET['id_file']));
//     $sql = $db->prepare("SELECT * FROM article where id = :id");
//     $sql->bindParam(':id', $id_file);
//     $sql->execute();
//     $fileEdit = $sql->fetch(PDO::FETCH_ASSOC);
// }

 ////////////////////////////////////////////////
if(isset($_POST['article']) && !empty($_POST['article']) && !isset($_GET['id_file'])){

    $article = htmlentities(strip_tags($_POST['article']));
    $position = $_POST['position'];

    $i = new ArticleManager();
    $i->insert($id, $article, $position);
/////////////////////////////////////////////////////


    //rajoueter id ou post id ???
    // $sql = $db->prepare(" INSERT INTO article (post_id, article, position) VALUES (:post_id, :article, :position)");
    // $sql->bindParam( ':post_id', $id );
    // $sql->bindParam( ':article', $article );
    // $sql->bindParam( ':position', $position );
    // $sql->execute();
////////////////////////////////
// }
////////////////////////////////


////////////////////////////////
if(isset($_POST['article']) && !empty($_POST['article']) && isset($_GET['id_file'])){

    $user_id =  $_SESSION['user']['id'];
    $article = htmlentities(strip_tags($_POST['article']));
    $position = $_POST['position'];

    $f = new ArticleManager();
    $f-> update($user_id, $article, $position); // id mis devant ?
////////////////////////////////



    // $sql = $db->prepare(" UPDATE article SET article = :article, image = '', position = :position WHERE id = :id");
    // $sql->bindParam( ':id', $id_file );
    // $sql->bindParam( ':article', $article );
    // $sql->bindParam( ':position', $position );
    // $sql->execute();

    ////////////////////////////////
    // header("Location: ?page=post_article_update&id=$id");
    ////////////////////////////////
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


////////////////////////////////
// $existing_articles = [];
// $e_a = new ArticleManager();
// $existing_articles = $e_a->getAll("SELECT article FROM article where post_id = $id");
////////////////////////////////





// var_dump($existing_articles);
// $db = Utils::connectDB();
// $sql = $db->prepare("SELECT article FROM article where post_id = :id"); 
// $sql->bindParam(':id', $id);
// // // plutot utiliser un bind param
// $sql->execute();
// $existing_articles = $sql->fetchAll(PDO::FETCH_ASSOC);

// echo "<pre>";
// var_dump($existing_articles);
// echo "</pre>";

////////////////////////////////
// if(isset($_POST['image']) && !empty($_POST['image']) && !isset($_GET['id_file'])){
//     $id = $_SESSION['user']['id'];
//     $image = htmlentities(strip_tags($_POST['image']));
//     $position = $_POST['position'];

//     $ins = new ArticleManager();
//     $ins->insert($id, $image, $position);
    ////////////////////////////////
    // $sql = $db->prepare(" INSERT INTO article (post_id, image, position) VALUES (:post_id, :image, :position)");
    // $sql->bindParam( ':post_id', $id );
    // $sql->bindParam( ':image', $image );
    // $sql->bindParam( ':position', $position );
    // $sql->execute();

    ////////////////////////////////
// }
// if(isset($_POST['image']) && !empty($_POST['image']) && isset($_GET['id_file'])){
//     $image = htmlentities(strip_tags($_POST['image']));
//     $position = $_POST['position'];
//     $id = $_SESSION['user']['id'];

//     $ins = new ArticleManager();
//     $ins->update($id, $image, $position);
    ////////////////////////////////



    // $sql = $db-> prepare ("UPDATE article SET image = :image, article = '', position = :position WHERE id = :id");
    // $sql->bindParam( ':image', $image );
    // $sql->bindParam( ':id', $id_file );
    // $sql->bindParam( ':position', $position );
    // $sql->execute();


    ////////////////////////////////
//     header("Location: ?page=post_update&id=$id");
// }
////////////////////////////////

// recupérer url bdd


////////////////////////////////
// $existing_images = [];
// $e_i = new ArticleManager();
// $existing_images = $e_i->getAll("SELECT image FROM article where post_id = $id");
////////////////////////////////




// $sql = $db->prepare("SELECT image FROM article where post_id = :id"); 
// $sql->bindParam(':id', $id);
// // // plutot utiliser un bind param
//  $sql->execute();
// $existing_images = $sql->fetchAll(PDO::FETCH_ASSOC);

////////////////////////////////
// $files_ordered = [];
// $f_o = new ArticleManager();
// $files_ordered = $f_o->getAll("SELECT article,image,position,id FROM article where post_id = $id order by position");
////////////////////////////////


// $sql = $db->prepare("SELECT article,image,position,id FROM article where post_id = :id order by position");
// $sql->bindParam(':id', $id);
// $sql->execute();
// $files_ordered = $sql->fetchAll(PDO::FETCH_ASSOC);



////////////////////////////////
// $value="";

// $actual_article = [];
// $a_a = new ArticleManager();
// $actual_article = $a_a->getAll("SELECT article FROM article where post_id = $id order by position");
////////////////////////////////





// $sql = $db->prepare("SELECT article FROM article where post_id = :id order by position");
// $sql->bindParam(':id', $id);
// $sql->execute();
// $actual_article = $sql->fetch(PDO::FETCH_ASSOC);



////////////////////////////////
// $actual_article_value = $actual_article['article'];
////////////////////////////////



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










        $template = './views/template_post_article_update.phtml';
        $this->render($template, [
        'title' => 'Welcome to the Admin Dashboard',
        'posts' => $posts,
        'user' => $_SESSION['user'],
        'articles' => $articles,
        // 'existing_images' => $existing_images,
        // 'existing_articles' => $existing_images,

        // 'files_ordered' => $files_ordered,
        // 'actual_article_value' => $actual_article_value,
        '$file_edit' => $file_edit,
        // 'value' => $value,


        ]);
    }


    }
    

}    