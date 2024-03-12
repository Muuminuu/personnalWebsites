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

    public function getOne ($query=null,$params=[]){
        $default_query = "SELECT * FROM ".self::$tableName." LIMIT 1";
        $sql_query = $query===null ? $default_query : $query;
        $row = [];
        $row = self::$db->select($sql_query,$params);
        return $row;
    }
    
    public function getOneUserAndContact ($id){
        $row = self::$db->select("SELECT * FROM user INNER JOIN contact ON contact.user_id = user.id WHERE user.id = ? LIMIT 1",[$id]);
        return $row;
    }
    //incomplet
    // public function getOneFromTwoTables ($id = null, $table=null){
    //     $where = !is_null($id) ? " WHERE id=?" : "";
    //     $join = !is_null($table) ? " INNER JOIN ".$table." on ".self::$tableName.".id = ".$table.".user_id" : "";
    //     $row = [];
    //     $row = self::$db->select("SELECT * FROM ".self::$tableName." ".$join." ".$where."LIMIT 1",[$id]);
    //     return $row;
    // }
    public function getAllBy ($query=null){
        $default_query = "SELECT * FROM ".self::$tableName." LIMIT 1";
        $sql_query = $query===null ? $default_query : $query;
        $row = [];
        $row = self::$db->select($sql_query);
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

        $query = "INSERT INTO ".self::$tableName." (".$str_fields.") VALUES (".$str_values.")";

        $insert = self::$db->query($query, $data);
        
        return $insert;    
    }

    public function delete($id = null){
        if(!is_null($id)){
            self::$db->query("DELETE FROM ".self::$tableName." WHERE id=?",[$id]);
            return true;
        }
        return false;
    }

    public function update($id = null, $data = []){
        $fields = self::$obj->getAttributes();
        foreach ($fields as $k => $v){ //email=?, password=?, roles=?
            $values[] = $v."=?"; 
        }
        $str_values = implode(',', $values);
        $update = self::$db->query("UPDATE ".self::$tableName." SET ".$str_values." WHERE id='".$id."'",$data);
        return $update;
    }
    public function updateAdam($query, $data = []){
        $update = self::$db->query($query, $data);
        return $update;
    }


}
