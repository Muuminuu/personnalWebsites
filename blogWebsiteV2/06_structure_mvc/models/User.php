<?php
require_once('./services/class/Database.php');
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


    // ne sert pas encore. A virer si pas besoin.
    public function getOne($id){
        $user = $this->db->select('SELECT * FROM user WHERE id=:id',[
            'id' => $id
        ]);
        return $user;
    }

//     public function insertPost($params){
        
//         $posts = $this->db->query()
//     }
}