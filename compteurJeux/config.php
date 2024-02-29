<?php
//nouvelle méthode
const CONFIG_SITE_TITLE = "Compteur pour Jeux";
//ancienneméthode
define("CONFIG_SITE_SLOGAN", "Un choix plus que restreint !");
//fonction de connexion à la base de données
const DB_HOST = "localhost";
const DB_PORT = "3306";
const DB_NAME = "cpt_jeux";
const DB_USER = "root";
const DB_PASS = ""; //rien ou root sur mac ou autre selon configurations

function connectDB() {
    $db = false; //vuqu'on attends true dans controller_home.php, si ca foire, restera a false
    try {
        $db = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME,DB_USER,DB_PASS);
    } catch (PDOException $e) {
        $error = $e;
        // tenter de réessayer la connexion après un certain délai, par exemple
        echo "Hum problème de connexion au serveur de base de données: ".$e;
    }
    return $db;
}

function isRole($role){
    $is_role = isset($_SESSION['user']) && in_array($role, json_decode($_SESSION['user']['roles']));
    // booléen qquir etourne vrai/faux
    return $is_role;
}
function dump($var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}
function inputCleaner($input){
    return htmlentities(strip_tags($input));
}

?>