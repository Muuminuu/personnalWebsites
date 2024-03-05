<?php

namespace App\Models;

use App\Models\Comments;
use App\Services\Database;
use App\Models\AbstractManager;

class CommentsManager extends AbstractManager
{
    public function __construct()
    {
        self::$db = new Database();
        self::$tableName = 'comments';
        self::$obj = new Comments();
    }
}
