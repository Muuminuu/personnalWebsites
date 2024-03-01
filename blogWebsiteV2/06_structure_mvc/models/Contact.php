<?php

//Vu avec Adam :  est bien nécessaire ? vu que je ne l'appelle que lorsque j'appelle user ? faire une requete ave user et join contact semble suffisant.
require_once('./services/class/Database.php');
class Contact {
    //propriété $db pour stocker PDO
    private $db;

    public function __construct(){
        $this->db = new Database();
        // c'est PDO !
    }
    public function getAll($nb=null,$query="SELECT * FROM contact ORDER BY id DESC "){
        $limit = !is_null($nb) ? " LIMIT ".$nb : "";
        // pas necessaire par notre PDO a un die(); mais pas précaution on le met.

        $contacts = [];
        $contacts = $this->db->selectAll($query.$limit);
        return $contacts;
    }

//     public function insertPost($params){
        
//         $posts = $this->db->query()
//     }
}