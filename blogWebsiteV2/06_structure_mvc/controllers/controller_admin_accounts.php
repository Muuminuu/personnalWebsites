<?php
// met dehors les ens pas admin
if (!isset($_SESSION['user']['roles']) || !in_array("ROLE_ADMIN",json_decode($_SESSION['user']['roles']))){
    header("Location:?page=home");
    exit();
}

$db = Utils::connectDB();
$users= [];
if ($db){
    $sql = $db->prepare("SELECT * FROM user");
    $sql->execute();
    $users = $sql->fetchAll(PDO::FETCH_ASSOC);
}

include "./views/base.phtml";

?>