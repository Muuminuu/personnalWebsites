<?php

namespace App\Models;
use App\Models\AbstractTable;

class Comments extends AbstractTable
{
    protected ?int $user_id = null;
    protected ?int $post_id = null;
    protected ?string $comment = null;

    public function setUserId($user_id){
        $this->user_id = $user_id;
    }
    
    public function setPostId($post_id){
        $this->post_id = $post_id;
    }

    public function setComment($comment){
        $this->comment = $comment;
    }

    public function toArray(){
        $commentArray= [
            $this->user_id,
            $this->post_id,
            $this->comment
        ];
        return $commentArray;
    }
}

