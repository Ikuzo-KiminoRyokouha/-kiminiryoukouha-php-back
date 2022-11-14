<?php
namespace App\Comment\Domain\Repositories;

use App\Comment\Domain\Entities\Comment;


class UpdateCommentRepository implements UpdateCommentRepositoryInterface{
    public function update($request,$id):bool{
        if(Comment::where('id' ,$id)->exists()){
            $fetchdData = Comment::find($id);
            $fetchdData->update($request->all());
            return true;
        }else{
            return false;
        }
    }
}