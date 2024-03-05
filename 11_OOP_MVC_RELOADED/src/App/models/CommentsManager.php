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

    public function deleteComments($post_id = null)
    {
        if (!is_null($post_id)){
            self::$db->query("DELETE FROM ".self::$tableName." WHERE post_id=?",[$post_id]);
            return true;
        }
        return false;
    }
}
