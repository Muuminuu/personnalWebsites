<?php

namespace App\Services;

class Utils {
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

    
    
