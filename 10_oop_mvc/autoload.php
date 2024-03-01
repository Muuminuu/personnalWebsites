<?php 

spl_autoload_register(function ($class_name) {
    $class_name = str_replace("\\", "/", $class_name); // codde pour linux ou mac, pb avec les antislash
    require "./src/". $class_name . '.php';
});