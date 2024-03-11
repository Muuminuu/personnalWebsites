<?php
namespace App\Todolist;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Todolist\Services\Database;
class TaskController {

    public function index() {

        // echo "page d'accueil";
        $loader = new FilesystemLoader(dirname(__DIR__) . "\\templates");
        $twig = new Environment($loader);

        $pdo = new Database(
            "127.0.0.1",
            "todolist",
            "3306",
            "root",
            ""
        );
        $tasks = $pdo->selectAll(
            "SELECT * from task"
        );


        echo $twig->render('taskpage.twig', [
            'name' => 'ToDo List',
            'tasks' => $tasks,

        ]);
    }
    public function new() {

        
        // echo "page d'accueil";
        // var_dump($_SERVER['REQUEST_METHOD']);
        $loader = new FilesystemLoader(dirname(__DIR__) . "\\templates");
        $twig = new Environment($loader);
        $pdo = new Database(
            "127.0.0.1",
            "todolist",
            "3306",
            "root",
            ""
        );

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $title = htmlentities(strip_tags($_POST['title']));
            $status = htmlentities(strip_tags($_POST['status']));
            $image = htmlentities(strip_tags($_POST['image']));

            $pdo->query(
                "INSERT INTO task (title, status, image) VALUES (?, ?, ?)",
                [$title, $status, $image]
            );
        header("Location: /personnalWebsites/todo_list/public/task/");
        }

        echo $twig->render('newtaskpage.twig', [

        ]);
    }

    public function show($id) {
        

$pdo = new Database(
    "127.0.0.1",
    "todolist",
    "3306",
    "root",
    ""
)  
;
$task = $pdo->select(
    "SELECT * from task where id = " . $id,
);


        // echo "page d'accueil";
        $loader = new FilesystemLoader(dirname(__DIR__) . "\\templates");
        $twig = new Environment($loader);
        echo $twig->render('detailtaskpage.twig', [
            'name' => 'ToDoList',
            // 'taskId' => $id,
            'task' => $task
            // 'task' => $taskToSend
        ]);
    }

    public function update($id) {
        $loader = new FilesystemLoader(dirname(__DIR__) . "\\templates");
        $twig = new Environment($loader);


        $pdo = new Database(
            "127.0.0.1",
            "todolist",
            "3306",
            "root",
            ""
        );
        $task = $pdo->select(
            "SELECT * from task where id = " . $id
        );

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = htmlentities(strip_tags($_POST['title']));
            $status = htmlentities(strip_tags($_POST['status']));
            $image = htmlentities(strip_tags($_POST['image']));
            $pdo->query(

            "update task set title = :title, status = :status, image = :image where id = :id",
            [
                'id' => $id,
                'title' => $title,
                'status' => $status,
                'image' => $image,
            ]
        );
        header("Location: /personnalWebsites/todo_list/public/task/");
        }

        
        

        echo $twig->render('updatetaskpage.twig', [
            'task' => $task
        ]);
    }

    public function delete(int $id)
    {
        $loader = new FilesystemLoader(dirname(__DIR__) . "\\templates");
        $twig = new Environment($loader);
        // la correspondance de l'id souhaite via une requete sql
        // Se connecter à la base de données
        $pdo = new Database(
            "127.0.0.1",
            "todolist",
            "3306",
            "root",
            ""
        );
        $pdo2 = $pdo;

        
        $pdo->query("DELETE FROM task WHERE id = " .$id);
        


        $task2 = $pdo2-> select("SELECT * from task");
        header('Location: /personnalWebsites/todo_list/public/task/');

        echo $twig->render('taskpage.twig', [

            'task2' => $task2
        ]);
    }
    
}