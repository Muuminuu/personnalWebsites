<?php
namespace App\Controllers;

use App\Models\PostManager;
use App\Controllers\AbstractController;
use App\Models\ArticleManager;
use App\Models\CommentsManager;

use App\Services\Utils;

class PostDetailController extends AbstractController{
    public function index(){
        


        // if (!isset($_SESSION['user']['roles']) || !in_array("ROLE_ADMIN",json_decode($_SESSION['user']['roles']))){
        //     header("Location:?page=home");
        //     exit();
        // }


        $manager = new PostManager();
        $sql = "SELECT post.*,contact.firstname,contact.lastname FROM post,contact WHERE post.id=? AND post.user_id=contact.user_id LIMIT 1";
        $posts = $manager->getOne($sql,[(int)$_GET['id']]);
        $post_id = ((int)($_GET['id']));

        if(isset($_POST['comment']) && !empty($_POST['comment'])){
            
            $comment = htmlentities(strip_tags($_POST['comment']));
            $user_id =  $_SESSION['user']['id'];
            $c = new CommentsManager();
            $c-> insert([$post_id, $user_id, $comment]);

            var_dump("salut");
        }
        $existing_comments = [];
        $e_c = new CommentsManager();
        $existing_comments = $e_c->getAll(null,"SELECT comments.*, contact.firstname, contact.lastname
                                    FROM comments
                                    INNER JOIN user ON user.id=comments.user_id
                                    INNER JOIN post ON post.id=comments.post_id
                                    INNER JOIN contact ON contact.user_id=user.id");


        $existing_articles = [];
        $e_a = new ArticleManager();
        $existing_articles = $e_a->getAll(null,"SELECT article FROM article where post_id = $post_id");


// bon code ?

        $files_ordered = [];
        $f_o = new ArticleManager();
        $files_ordered = $f_o->getAll(null,"SELECT article,image,position,id FROM article where post_id = $post_id order by position");
        

// $post_id = (int)$_GET['id'];
// $manager = new PostManager();
// $sql = "SELECT post.*,contact.firstname,contact.lastname FROM post,contact WHERE post.id=? AND post.user_id=contact.user_id LIMIT 1";
// $post = $manager->getOne($sql,[$post_id]);
// $sql = "SELECT comments.*,contact.firstname,contact.lastname FROM comments,contact WHERE comments.post_id='".$post_id."' AND comments.user_id=contact.user_id";
// $c_manager = new CommentsManager();
// $comments = $c_manager->getAll(null,$sql);

// à garder au cas où
// version du prof fonctionnelle -> bien envoyer $post et $ comments dans le render.


        // requete pour tous les posts et nom/prenom auteur
        $template = "./views/template_post_detail.phtml";
        $this->render($template,[
            'posts'=>$posts,
            'existing_comments'=>$existing_comments,
            'existing_articles'=>$existing_articles,
            'files_ordered'=>$files_ordered,
            'post_id'=>$post_id,
        ]);
    }


    public function add_comment(){
        $post_id = ((int)($_GET['id']));
        $user_id =  $_SESSION['user']['id'];
        if (isset($_POST['comment']) && !empty($_POST['comment']))
        {
            $c_manager = new CommentsManager();
            $comment = Utils::inputCleaner($_POST['comment']);
            $insert = $c_manager->insert([ $user_id, $post_id, $comment]);
            header("Location:?page=postdetail&id=$post_id");
        }
    
    }
}
    
