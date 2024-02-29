<?php
require_once('./services/class/Database.php');
class Coment {
    //propriété $db pour stocker PDO
    private $db;

    public function __construct(){
        $this->db = new Database();
        // c'est PDO !
    }
    public function getAll($nb=null,$query="SELECT * FROM comments ORDER BY id DESC "){
        $limit = !is_null($nb) ? " LIMIT ".$nb : "";
        // pas necessaire par notre PDO a un die(); mais pas précaution on le met.

        $coments = [];
        $coments = $this->db->selectAll($query.$limit);
        return $coments;
    }

//     public function insertPost($params){
        
//         $posts = $this->db->query()
//     }
}