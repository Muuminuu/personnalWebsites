<?php
class Utils{


//fonction de connexion à la base de données
const DB_HOST = "localhost";
const DB_PORT = "3306";
const DB_NAME = "blog_php";
const DB_USER = "root";
const DB_PASS = ""; //rien ou root sur mac ou autre selon configurations

    //rajouter static devant chaque fonction
    static function connectDB() {
        $db = false; //vuqu'on attends true dans controller_home.php, si ca foire, restera a false
        try {
            $db = new PDO('mysql:host='.self::DB_HOST.';port='.self::DB_PORT.';dbname='.self::DB_NAME,self::DB_USER,self::DB_PASS);
        } catch (PDOException $e) {
            $error = $e;
            // tenter de réessayer la connexion après un certain délai, par exemple
            echo "Hum problème de connexion au serveur de base de données: ".$e;
        }
        return $db;
    }
    static function isRole($role){
        $is_role = isset($_SESSION['user']) && in_array($role, json_decode($_SESSION['user']['roles']));
        // booléen qquir etourne vrai/faux
        return $is_role;
    }
    static function dump($var){
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }
    // static function dump_die($var){
    //     echo "<pre>";
    //     var_dump($var);
    //     echo "</pre>";
    //     die();
    // }
    static function inputCleaner($input){
        return htmlentities(strip_tags($input));
    }
    
}