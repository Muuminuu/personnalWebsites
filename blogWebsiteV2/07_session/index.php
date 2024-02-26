
<?php

session_start();

$_SESSION['user'] = "Paul";
$_SESSION['maman'] = "Geogette";
$_SESSION['papa'] = "Henri";
$_SESSION['famille'] = "Duchemoel";
$_SESSION['plat_preferes'] = ['Pates','Pizza','Bière','PHP'];
$_SESSION[0] = 23456;

echo "<pre>";
var_dump($GLOBALS);
echo "</pre>";

?>