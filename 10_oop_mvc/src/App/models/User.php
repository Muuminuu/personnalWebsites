<?php

namespace App\Models;
use App\Services\Database;


class User {
    //propriété $db pour stocker PDO
    private $db;

    public function __construct(){
        $this->db = new Database();
        // c'est PDO !
    }
    public function getAll($nb=null,$query="SELECT * FROM user ORDER BY id DESC "){
        $limit = !is_null($nb) ? " LIMIT ".$nb : "";
        // pas necessaire par notre PDO a un die(); mais pas précaution on le met.

        $users = [];
        $users = $this->db->selectAll($query.$limit);
        return $users;
    }

    public function getOne($nb=null,$query="SELECT * FROM user ORDER BY id DESC "){
        $limit = !is_null($nb) ? " LIMIT ".$nb : "";
        // pas necessaire par notre PDO a un die(); mais pas précaution on le met.

        $user = $this->db->select($query.$limit);
        return $user;
    }

    // public function getOne($id){
    //     $user = $this->db->select('SELECT * FROM user WHERE id=:id',[
    //         'id' => $id
    //     ]);
    //     return $user;
    // }

    public function insertUser($email,$password,$role){
        $query = "INSERT INTO user
         (email, password, roles) VALUES (:email, :password, :roles)";
        $params = [
            'email' => $email,
            'password' => $password,
            'roles' => $role
        ];
        $insert =$this->db->query($query,$params);
        return $insert;
        // retourne PDO au caso ù on souhaite utiliser le last insert id.
    }
}