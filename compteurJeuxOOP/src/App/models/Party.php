<?php

namespace App\Models;
use App\Services\Database;


class Party {
    //propriété $db pour stocker PDO
    private $db;

    public function __construct(){
        $this->db = new Database();
        // c'est PDO !
    }
    public function getAll($nb=null,$query="SELECT * FROM party ORDER BY id DESC "){
        $limit = !is_null($nb) ? " LIMIT ".$nb : "";
        // pas necessaire par notre PDO a un die(); mais pas précaution on le met.

        $parties = [];
        $parties = $this->db->selectAll($query.$limit);
        return $parties;
    }  

    public function getOne($id){
        $party = $this->db->select('SELECT * FROM party WHERE id=:id',[
            'id' => $id
        ]);
        return $party;
    }

    public function insert($id,$game,$results,$winner){
        $query = "INSERT INTO party (user_id, user_games, results, winner) VALUES (:user_id,:user_games, :results, :winner)";
        $params = [
            'user_id' => $id,
            'user_games' => $game,
            'results' => $results,
            'winner' => $winner
        ];
        $insert =$this->db->query($query,$params);
        return $insert;
        // retourne PDO au caso ù on souhaite utiliser le last insert id.
    }

    // delete codium, à voir
    public function delete($id){
        $query = "DELETE FROM party WHERE id=:id";
        $delete = $this->db->query($query,[
            'id' => $id
        ])
        // return $delete;
    }

    public function update($id){
        $query = "UPDATE party SET user_games = :user_games, results = :results, winner = :winner WHERE id = :id";
        $update = $this->db->query($query,[
            'id' => $id,
            'user_games' => $user_games,
            'results' => $results,
            'winner' => $winner

        ]);
        return $update;
    }

    public function getResults(){
        
    }
    public function getWinner(){
        
    }
}