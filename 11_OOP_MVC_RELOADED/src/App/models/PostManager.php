<?php

namespace App\Models;

use App\Models\Post;
use App\Services\Database;
use App\Models\AbstractManager;

class PostManager extends AbstractManager
{
    public function __construct()
    {
        self::$db = new Database();
        self::$tableName = 'post';
        self::$obj = new Post();
    }
}
