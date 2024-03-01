<?php

namespace App\Services;

use PDO;
use PDOException;

class Database {
    private $db_host;
    private $db_name;
    private $db_port;
    private $db_user;
    private $db_pass;
    // un dsn est une ligne de commande pour se connecter à la base de données. Data Source Name.
    private $db_dsn;
    // PDO
    private $pdo;
    
    public function __construct(
        $db_host = "localhost",
        $db_name = "blog_php",
        $db_port = "3306",
        $db_user = "root",
        $db_pass = ""
        ){
        $this->db_host = $db_host;
        $this->db_name = $db_name;
        $this->db_port = $db_port;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_dsn = 'mysql:host='.$this->db_host.';port='.$this->db_port.';dbname='.$this->db_name.';charset=utf8';
    }

    private function getPDO(){
        if($this->pdo === null){
            try {
                $db = new PDO($this->db_dsn,$this->db_user,$this->db_pass);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $error) {
                // iconv pour les lettres spéciales avec accent
                echo "Hum problème de connexion au serveur de base de données: ".iconv('ISO-8859-1', 'UTF-8',$error->getMessage());
                die(); // car inutile de continuer si une erreur est survenue.
            }
            $this->pdo = $db;
        }
        return $this->pdo;
    }

    public function selectAll($statement,$params=[]){
        $sql = $this->getPDO()->prepare($statement);
        $sql->execute($params);
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        //le bind param sera ajusté grace au tableau de params-> adaptatif.
    }
    public function select($statement,$params=[]){
        $sql = $this->getPDO()->prepare($statement);
        $sql->execute($params);
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    public function query($statement,$params=[]){
        $sql = $this->getPDO()->prepare($statement);
        $sql->execute($params);
        return $this->getPDO();
    }
    //query remplace tout ce qui n'est pas un select : insert, update, delete.
}