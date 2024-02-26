<?php
//nouvelle méthode
const CONFIG_SITE_TITLE = "Mon Superbe MVC";
//ancienneméthode
define("CONFIG_SITE_SLOGAN", "Mon Superbe MVC au top");
//fonction de connexion à la base de données
const DB_HOST = "localhost";
const DB_PORT = "3306";
const DB_NAME = "blog_php";
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

?>