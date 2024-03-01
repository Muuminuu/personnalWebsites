<?php

namespace App\Models;
use App\Services\Database;


class Article {
    //propriété $db pour stocker PDO
    private $db;

    public function __construct(){
        $this->db = new Database();
        // c'est PDO !
    }
    public function getAll($nb=null,$query="SELECT * FROM article ORDER BY id DESC "){
        $limit = !is_null($nb) ? " LIMIT ".$nb : "";
        // pas necessaire par notre PDO a un die(); mais pas précaution on le met.

        $articles = [];
        $articles = $this->db->selectAll($query.$limit);
        return $articles;
    }  

    public function getOne($id){
        $user = $this->db->select('SELECT * FROM article WHERE id=:id',[
            'id' => $id
        ]);
        return $user;
    }

    public function insertPost($title,$description,$id){
        $query = "INSERT INTO post (title, description,  user_id) VALUES (:title, :description, :user_id)";
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