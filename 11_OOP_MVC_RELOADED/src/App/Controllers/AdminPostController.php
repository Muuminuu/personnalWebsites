<?php
namespace App\Controllers;

use App\Services\Utils;
use App\Models\PostManager;
use App\Models\CommentsManager;

use App\Models\UserManager;
use App\Services\Authenticator;
use App\Controllers\AbstractController;

class AdminPostController extends AbstractController{
    public function __construct() {
        if(!Authenticator::isRole("ROLE_ADMIN")){
            header('Location: ?page=home'); // sera login quand on aura une page admin ???
            die();
        }
        //des que le routeur fait un new controlle (router), ca fait cette fonction construct.
        //On ne veut pas que tous les controlleurs redirigent les gens. Seulement
    }

    public function index() {
// WIP CACA 
        $template = './views/template_admin_post_add.phtml';
        $this->render($template, [

        ]);
    }

    public function create() {

        $manager = new PostManager();
        if (isset($_POST['title'])) {
            $title = Utils::inputCleaner($_POST['title']);
            $description = Utils::inputCleaner($_POST['description']);
            $image = Utils::inputCleaner($_POST['image']);
            $insert = $manager->insert([
                $_SESSION['user']['id'],
                $title,
                $description,
                $image,
                date("Y-m-d H:i:s"),
            ]);
            $lastid = $insert-> lastInsertId();
        }
        header ("Location:?page=admin&newpost=".$lastid);
        die();
    }
    public function delete() {

        
        $post_id = (int)$_GET['id'];
        $manager = new CommentsManager();
        $deleteComment = $manager->deleteComments($post_id);
        $manager = new PostManager();
        $delete = $manager->delete($post_id);

        header("Location:?page=admin");
    }
        
    public function update() 
    {
        $post_id = (int)$_GET['id'];
        var_dump($post_id);
        $manager = new PostManager();
        if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['image']) && !empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['image'])) {
            $title = Utils::inputCleaner($_POST['title']);
            $description = Utils::inputCleaner($_POST['description']);
            $image = Utils::inputCleaner($_POST['image']);
            $update = $manager->update($post_id, [
                $_SESSION['user']['id'],
                $title,
                $description,
                $image,
                date("Y-m-d H:i:s"),
            ]);
            header ("Location:?page=admin");
        }
        $post = $manager->getOneById($post_id);
        $template = './views/template_admin_post_update.phtml';
        $this->render($template, [
            'post' => $post,
            'post_id' => $post_id,
        
        ]);
    }


    }
    

    