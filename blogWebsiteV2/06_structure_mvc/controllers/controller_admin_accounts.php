<?php
// met dehors les ens pas admin
if (!isset($_SESSION['user']['roles']) || !in_array("ROLE_ADMIN",json_decode($_SESSION['user']['roles']))){
    header("Location:?page=home");
    exit();
}



include "./views/base.phtml";

?>