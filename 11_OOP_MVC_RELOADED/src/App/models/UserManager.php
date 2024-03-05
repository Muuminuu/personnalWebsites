<?php
namespace App\Models;

use App\Models\User;
use App\Services\Database;
use App\Models\AbstractManager;

class UserManager extends AbstractManager
{
    public function __construct()
    {
        self::$db = new Database();
        self::$tableName = 'user';
        self::$obj = new User();
    }

    public function getUserByEmail($email = null):array|false
    {
        // SELET * FRO user WHERE email=?
        // "SELECT user.*,contact.lastname,contact.firstname FROM user,contact  WHERE email=:email AND user.id=contact.user_id LIMIT 1"); 
        $where = !is_null($email) ? " WHERE email=?" : "";
        $row = [];
        $row = self::$db->select("SELECT user.*,contact.lastname,contact.firstname FROM user,contact ".$where." AND user.id=contact.user_id LIMIT 1",[$email]);
        return $row;
    }
}