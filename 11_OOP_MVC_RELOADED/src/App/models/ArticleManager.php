<?php
namespace App\Models;

use App\Models\User;
use App\Services\Database;
use App\Models\AbstractManager;

class ArticleManager extends AbstractManager
{
    public function __construct()
    {
        self::$db = new Database();
        self::$tableName = 'article';
        self::$obj = new Article();
    }


}