<?php

namespace App\Models;
use App\Models\AbstractTable;

class User extends AbstractTable
{
    protected ?string $email = null;
    protected ?string $password = null;
    protected ?string $roles = null;
    private ?string $registered_at = null;

    public function setEmail($email){
        $this->email = $email;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function setRoles($roles){
        $this->roles = $roles;
    }
    public function setRegisteredAt(){
        $this->registered_at = date('Y-m-d H:i:s');
    }
    public function toArray(){
        $userArray= [
            $this->email,
            $this->password,
            $this->roles,
            $this->registered_at
        ];
        return $userArray;
    }
}