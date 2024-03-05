<?php
namespace App\Controllers;

use App\Models\UserManager;
use App\Models\PostManager;
use App\Controllers\AbstractController;
use App\Services\Authenticator;

//gère la redirection si pas le role souhaité
class SearchController extends AbstractController {

    public function __construct() {
        if(!Authenticator::isRole("ROLE_ADMIN")){
            header('Location: ?page=home'); // sera login quand on aura une page admin ???
            die();
        }
        //des que le routeur fait un new controlle (router), ca fait cette fonction construct.
        //On ne veut pas que tous les controlleurs redirigent les gens. Seulement
    }
    public function index() {
        $keywords = strip_tags(urldecode(trim($_GET['keywords'])));
        $posts = [];
        
        $post = new PostManager();
        $posts = $post->getAll(null,"SELECT * FROM post WHERE title LIKE '%".$keywords."%' OR description LIKE '%".$keywords."%' OR image LIKE '%".$keywords."%' ORDER BY id");
        $template = './views/template_search.phtml';
        $this->render($template, [
        'posts' => $posts,
        'keywords' => $keywords
        ]);
    }
    
}
