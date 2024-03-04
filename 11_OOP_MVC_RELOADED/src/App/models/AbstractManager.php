<?php

namespace App\Models;

abstract class AbstractManager
{
    protected static $db;
    protected static $tableName;
    protected static $obj;

    public function getAll($nb = null, $query=null)
    {
        $limit = !is_null($nb) ? " LIMIT ".$nb : "";
        $results = [];
        $default_query = "SELECT * FROM ".self::$tableName." ORDER BY id DESC";
        $sql_query = $query===null ? $default_query : $query;
        $results = self::$db->selectAll($sql_query.$limit);
        return $results;
    }

    public function getOneById($id = null):array
    {
        $where = !is_null($id) ? " WHERE id=?" : "";
        $row = [];
        $row = self::$db->select("SELECT * FROM ".self::$tableName." ".$where."LIMIT 1",[$id]);
        return $row;
    }

    public function insert ($data = [])
    {
        $fields = self::$obj->getAttributes();
        foreach ($fields as $v){ //email, pâssword, roles
            $values[] = "?"; // ? , ? , ?
        }
        // on veut obtenir une requete du type
        // insert INTO user (email, password, roles) VALUES (?, ?, ?)
        $str_fields = implode(',', $fields);
        $str_values = implode (',', $values);
        $insert = self::$db->query("INSERT INTO ".self::$tableName." (".$str_fields.") VALUES (".$str_values.")", $data);
    }
    
}
