<?php

namespace App\Services;

class Utils {
    
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

    
    
