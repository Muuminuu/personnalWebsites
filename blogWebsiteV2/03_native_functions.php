<?php

$today = date("j, n, Y");  
echo "<h1>$today</h1>";

//afficher le nombre de secondes ecoulées depuis le premier janvier 1970
$time = time();
echo "<h2>Nombre de secondes écoulées depuis janvier 1970, soit"." ".$time. " "." secondes.</h2>";

$pi = pi();
echo  "La valeur approximative de Pi est : $pi<br />";

$racineCarre = sqrt(9);
echo "<h2>$racineCarre</h2>";



$random = rand(0,2);
echo  "Random Number: $random <br>";  // Outputs a random number between 0 and

$array_img = [
    "https://cdn.pixabay.com/photo/2013/10/02/23/03/mountains-190055_960_720.jpg",
    "https://cdn.pixabay.com/photo/2016/11/23/13/48/beach-1852945_960_720.jpg",
    "https://cdn.pixabay.com/photo/2014/11/16/15/15/field-533541_960_720.jpg",
];

echo "<h3>Retoruner du Json</h3>";
echo json_encode($array_img);

echo "<h3>compter nb entrées tableau</h3>";
echo count($array_img);

$source = $array_img[$random];

echo "<img src=\"$source\" alt=\"Random image\" width=100%>";

