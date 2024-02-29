<?php
require_once('./services/class/Database.php');
class Post {
    //propriété $db pour stocker PDO
    private $db;

    public function __construct(){
        $this->db = new Database();
        // c'est PDO !
    }
    public function getAll($nb=null,$query="SELECT * FROM post ORDER BY id DESC "){
        $limit = !is_null($nb) ? " LIMIT ".$nb : "";
        // pas necessaire par notre PDO a un die(); mais pas précaution on le met.

        $posts = [];
        $posts = $this->db->selectAll($query.$limit);
        return $posts;
    }

    public function insertPost($title,$description,$id){
        $query = "INSERT INTO post (title, description, created_at, user_id) VALUES (:title, :description, NOW(), :user_id)";
        $params = [
            'title' => $title,
            'content' => $description,
            'user_id' => $id
        ];
        $insert =$this->db->query($query,$params);
        return $insert;
        // retourne PDO au caso ù on souhaite utiliser le last insert id.
    }
}