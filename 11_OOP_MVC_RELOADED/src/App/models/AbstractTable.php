<?php

namespace App\Models;

abstract class AbstractTable
{
    protected ?int $id = null;
    protected ?string $className = null;

    public function __construct(?int $id = null){
        $this->id = $id;
        $this->setClassName($this); // car class user ira se connecter a la table user

    }
    public function setClassName(?object $obj): void
    {
        $this->className = get_class($obj);
    }

    public function getClassName(): ?string{ //peut retourner une chaine
        return $this->className;
    }
    /**
     * @return arrray of attributes
     */
    public function getAttributes(): ?array
    {
        $attributes = [];
        // we do not want to get id and className for insert and update SQL queries.
        $filter = ['id','className'];
        $class = get_class_vars($this->getClassName());//recupère les attributs d'une classe
        foreach($class as $k => $v){
            if(!in_array($k, $filter))$attributes[$k] = $v;
        }
        return $attributes;
    }

}
