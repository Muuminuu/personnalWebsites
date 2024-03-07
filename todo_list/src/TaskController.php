<?php
namespace App\Todolist;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
class TaskController {

    public function new() {
        echo "creation nouvelle tache";
        $tasks = [

        ];
        // echo "page d'accueil";
        $loader = new FilesystemLoader(dirname(__DIR__) . "\\templates");
        $twig = new Environment($loader);
        echo $twig->render('taskpage.twig', [
            'name' => 'Jean Forteroche',
            'tasks' => $tasks
        ]);
    }

    public function show($id) {
        $tasks = [
            "faire les courses",
            "faire le ménage",
            "faire la vaisselle"
        ];
        echo "voici la page de la tâche n° " . $id;
        // echo "page d'accueil";
        $loader = new FilesystemLoader(dirname(__DIR__) . "\\templates");
        $twig = new Environment($loader);
        echo $twig->render('taskpage.twig', [
            'name' => 'Jean Forteroche',
            'tasks' => $tasks
        ]);
    }

    public function index() {
        $tasks = [
            "faire les courses",
            "faire le ménage",
            "faire la vaisselle"
        ];
        // echo "page d'accueil";
        $loader = new FilesystemLoader(dirname(__DIR__) . "\\templates");
        $twig = new Environment($loader);
        echo $twig->render('taskpage.twig', [
            'name' => 'Jean Forteroche',
            'tasks' => $tasks
        ]);
    }
}