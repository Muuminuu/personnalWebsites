<?php

namespace App\Services;

use App\Models\UserManager;

class Authenticator
{
    public function __construct()
    {
        if(!isset($_SESSION)) session_start();
        // si on trouve un cookie qui porte le nom défini dans la config.
        // On va créer une session à partir des infos du cookie.
        if(isset($_COOKIE[CONFIG_COOKIE_NAME]) && !empty ($_COOKIE[CONFIG_COOKIE_NAME])){
            $cookieData = unserialize($_COOKIE[CONFIG_COOKIE_NAME]);
            $this->setSession($cookieData);
        }
        if (isset($_POST['cookie_yes'])) $_SESSION['cookie'] = true;
        if (isset($_POST['cookie_no'])) $_SESSION['cookie'] = false;
    }
    
    private function setSession($userData)
    {
        $_SESSION['user'] = $userData;
    }

    public function login($email, $password)
    {
        $isLogged = false;
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);
        if ($user){
            $isLogged = password_verify($password, $user['password']);
        }
        if ($isLogged){
            $this->setSession($user);
        }
        return $isLogged;
    }

    public function logout()
    {
        session_destroy();
        if (isset($_COOKIE[CONFIG_COOKIE_NAME])){
            setcookie(CONFIG_COOKIE_NAME, '', time() - 1);
        }

    }

    static function isRole($role)
    {
        $is_role = isset($_SESSION['user']) && in_array($role, json_decode($_SESSION['user']['roles']));
        // booléen qquir etourne vrai/faux
        return $is_role;
    }
}