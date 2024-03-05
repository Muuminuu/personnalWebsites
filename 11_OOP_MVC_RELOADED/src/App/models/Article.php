<?php

namespace App\Models;
use App\Models\AbstractTable;

class Article extends AbstractTable
{
    //lister tous les champs de la table
    protected ?int $post_id = null;
    protected ?string $article = null;
    protected ?string $image = null;
    protected ?int $position = null;

    public function setPostId($post_id){
        $this->post_id = $post_id;
    }
    public function setArticle($article){
        $this->article = $article;
    }

    public function setImage($image){
        $this->image = $image;
    }

    public function setPosition($position){
        $this->position = $position;
    }

    public function toArray(){
        $articleArray= [
            $this->post_id,
            $this->article,
            $this->image,
            $this->position
        ];
        return $articleArray;
    }
}