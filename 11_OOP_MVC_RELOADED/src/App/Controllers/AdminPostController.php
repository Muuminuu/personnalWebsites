<?php
namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\CommentsManager;
use App\Models\PostManager;
use App\Models\UserManager;
use App\Services\Authenticator;


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

        $template = './views/template_admin_post.phtml';
        $this->render($template, [

        ]);
    }

    public function create() {

        $template = './views/template_admin_post_add.phtml';
        $this->render($template, [

        ]);
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
        $manager = new PostManager();
        $post = $manager->getOneById($post_id);
        $template = './views/template_admin_post_update.phtml';
        $this->render($template, [
            'post' => $post,
            'post_id' => $post_id,
            
        ]);
    }


    }
    

    