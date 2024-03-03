<?php

namespace App\Models;
use App\Services\Database;


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

    public function getOne($id){
        $user = $this->db->select('SELECT * FROM post WHERE id=:id',[
            'id' => $id
        ]);
        return $user;
    }

    public function insertPost($title,$topic,$image,$description,$id){
        $query = "INSERT INTO post (title, topic, image, description,  user_id) VALUES (:title, :topic, :image, :description, :user_id)";
        $params = [
            'title' => $title,
            'topic' => $topic,
            'image' => $image,
            'content' => $description,
            'user_id' => $id
        ];
        $insert =$this->db->query($query,$params);
        return $insert;
        // retourne PDO au caso ù on souhaite utiliser le last insert id.
    }
}