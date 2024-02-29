<?php
        $getPage = isset($_GET['page']) ? strtolower($_GET['page']) : 'home'; 
        $path = "./controllers/controller_" .$getPage. ".php";
        $page = file_exists($path) ? $getPage : "404";
        // avant on  mettait home a la place de 404
?>