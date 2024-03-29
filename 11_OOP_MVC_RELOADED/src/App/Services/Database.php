<?php

namespace App\Services;

use PDO;
use PDOException;
// pas obligé car autoloder chargé apres la config dans index.
require_once './config.php';

class Database {
    //prorpiétés encapsulées dans la classe
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
        $db_host = DB_HOST,
        $db_name = DB_NAME,
        $db_port = DB_PORT,
        $db_user = DB_USER,
        $db_pass = DB_PASS
        ){
        // injection à ce moment là
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