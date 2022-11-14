<?php
namespace App\Comment\Domain\Repositories;

use App\Comment\Domain\Entities\Comment;

class RestoreCommentRepository implements  RestoreCommentRepositoryInterface{
    public function restore($id):bool{ 
        if(Comment::where('id',$id)->onlyTrashed()->exists()){
            Comment::withTrashed()
            ->where('id', $id)
            ->restore(); 
            return true;
        }else{
            return false;
        }

    }
}