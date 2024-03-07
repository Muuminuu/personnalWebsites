<?php
namespace App\Todolist;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class HomeController {
    public function index() {
        $tasks = [
            "faire les courses",
            "faire le ménage",
            "faire la vaisselle"
        ];
        // echo "page d'accueil";
        $loader = new FilesystemLoader(dirname(__DIR__) . "\\templates");
        $twig = new Environment($loader);
        echo $twig->render('homepage.twig', [
            'name' => 'Jean Forteroche',
            'tasks' => $tasks
        ]);
    }
}

