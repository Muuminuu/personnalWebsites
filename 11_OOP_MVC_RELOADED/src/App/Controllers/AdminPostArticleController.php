<?php
namespace App\Controllers;

use App\Services\Utils;
use App\Models\PostManager;
use App\Models\ArticleManager;
use App\Models\CommentsManager;

use App\Models\UserManager;
use App\Services\Authenticator;
use App\Controllers\AbstractController;

class AdminPostArticleController extends AbstractController{
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

        $template = './views/template_post_article_update.phtml';
        $this->render($template, [
        'title' => 'Welcome to the Admin Dashboard',
        'posts' => $posts,
        'user' => $_SESSION['user'],
        'articles' => $articles
        ]);
    }


    }
    

    