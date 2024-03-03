<?php

namespace App\Models;
use App\Services\Database;


class Contact {
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

    public function insertContact($user_id,$firstname,$lastname,$address1,$address2,$city,$state,$zip,$message){
        $query = "INSERT INTO contact (user_id, firstname, lastname, address1, address2, city, state, zip, message) VALUES (:user_id, :firstname, :lastname, :address1, :address2, :city, :state, :zip, :message)";
        $params = [
            'user_id' => $user_id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'address1' => $address1,
            'address2' => $address2,
            'city' => $city,
            'state' => $state,
            'zip' => $zip,
            'message' => $message
        ];
        $insert =$this->db->query($query,$params);
        return $insert;
        // retourne PDO au caso ù on souhaite utiliser le last insert id.
    }
}