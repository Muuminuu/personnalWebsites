<?php

namespace App\Services;

use App\Models\UserManager;

class Authenticator
{
    public function __construct()
    {
        if(!isset($_SESSION)) session_start();
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
    }

    static function isRole($role)
    {
        $is_role = isset($_SESSION['user']) && in_array($role, json_decode($_SESSION['user']['roles']));
        // booléen qquir etourne vrai/faux
        return $is_role;
    }
}