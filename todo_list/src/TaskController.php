<?php
namespace App\Todolist;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Todolist\Services\Database;
use App\Todolist\Repository\TaskRepository;



class TaskController {

    public function index() {

        // echo "page d'accueil";
        $loader = new FilesystemLoader(dirname(__DIR__) . "\\templates");
        $twig = new Environment($loader);

        // $taskRepository = new TaskRepository();
        // $tasks = $taskRepository->index();
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
            $user = htmlentities(strip_tags($_POST['user']));

            $pdo->query(
                "INSERT INTO task (title, status, image, user) VALUES (?, ?, ?, ?)",
                [$title, $status, $image, $user]
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
            $user = htmlentities(strip_tags($_POST['user']));
            $pdo->query(

            "update task set title = :title, status = :status, image = :image, user = :user where id = :id",
            [
                'id' => $id,
                'title' => $title,
                'status' => $status,
                'image' => $image,
                'user' => $user
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
        
        // $task2 = $pdo2-> select("SELECT * from task");
        header('Location: /personnalWebsites/todo_list/public/task/');

        // echo $twig->render('taskpage.twig', [

        //     'task2' => $task2
        // ]);
    }
     public function search () {


        $loader = new FilesystemLoader(dirname(__DIR__) . "\\templates");
        $twig = new Environment($loader);
        $keyword = strip_tags(urldecode(trim($_POST['keyword'])));
        $tasks = [];
            
        $pdo = new Database(
            "127.0.0.1",
            "todolist",
            "3306",
            "root",
            ""
        );

        $tasks = $pdo->selectAll("SELECT * FROM task WHERE title LIKE '%".$keyword."%' OR status LIKE '%".$keyword."%' OR image LIKE '%".$keyword."%' OR user LIKE '%".$keyword."%' ORDER BY id");


        echo $twig->render('searchpage.twig', [
            'tasks' => $tasks,
            'keyword' => $keyword
        ]);
        
        
     }

     public function updateStatus($id) {
         
        $loader = new FilesystemLoader(dirname(__DIR__) . "\\templates");
        $twig = new Environment($loader);
        $pdo = new Database(
             "127.0.0.1",
             "todolist",
             "3306",
             "root",
             ""
        );
        
        $updated_status = $pdo->select("SELECT status FROM task WHERE id = " . $id);
        $updated_status = $updated_status['status'];
        var_dump($updated_status);
        if ($updated_status == 'in_progress')
        {
            $updated_status = 'done';
        }
        if ($updated_status == 'pending')
        {
            $updated_status = 'in_progress';
        }


        $pdo->query("UPDATE task SET status = :status WHERE id = " . $id,["status" => $updated_status]);
        
        // $task2 = $pdo2-> select("SELECT * from task");
        header('Location: /personnalWebsites/todo_list/public/task/');

        echo $twig->render('taskpage.twig', [
            'updated_status' => $updated_status
    
            ]);
    }
    
}