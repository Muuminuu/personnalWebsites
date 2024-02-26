<?php
// include permet de charger un fichier externe
//include ne retroune qu'un warning en cas de pb de chargement
include("./05_texte.txt"); 
require("./05_texte.html");
require("./06_texte.php");
// même chose avec require, mais retourne une erreur fatale en cas d'échec de chargement.
echo $date;

$server = $_SERVER;
var_dump($server);


?>