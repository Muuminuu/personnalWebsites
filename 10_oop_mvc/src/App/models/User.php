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

    public function login($email, $password) {
        // Select user from the database based on the provided email
        $user = $this->db->select('SELECT * FROM user WHERE email=:email', [
            'email' => $email,
        ]);
    
        // Check if a user with the provided email exists
        if (!$user) {
            return "User not found.";
        }
    
        // Verify the password
        if (!password_verify($password, $user['password'])) {
            return "Invalid password.";
        }
    
        // Return the user data if login is successful
        return $user;
    }


    public function getId(){
        if(isset($_SESSION)){
            $id = $_SESSION['user']['id'];
        return $id;
        }
    }
    
    public function getUser($id) {
        try {
            // Select user information along with their contact information
            $u = $this->db->select('SELECT * FROM user INNER JOIN contact ON user.id = contact.user_id WHERE user.id=:id', [
                'id' => $id
            ]);
            
            // Check if any data was retrieved
            if (!$u) {
                return "User not found.";
            }
    
            return $u;
        } catch (Exception $e) {
            return "Error fetching user data: " . $e->getMessage();
        }
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