<?php
namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\PostManager;

class HomeController extends AbstractController
{
    public function index(){
        $title = "Hello OOP world";
        $dbPost = new PostManager();
        $posts = $dbPost->getAll(3);
        $template = './views/template_home.phtml';
        $this->render($template,[
            "title"=>$title,
            "posts"=>$posts]);
        }

        public function new(){
            $title = "Hello OOP world  page new";
            $dbPost = new PostManager();
            $posts = $dbPost->getAll(3);
            $template = './views/template_home_new.phtml';
            $this->render($template,[
                "title"=>$title,
                "posts"=>$posts]);
        }
}
