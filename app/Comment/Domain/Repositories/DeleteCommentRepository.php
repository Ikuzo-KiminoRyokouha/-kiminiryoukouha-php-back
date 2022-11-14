<?php
namespace App\Comment\Domain\Repositories;

use App\Comment\Domain\Entities\Comment;


class DeleteCommentRepository implements  DeleteCommentRepositoryInterface{
    public function delete($id):bool{
        if(Comment::where('id',$id)->exists()){
            $fetchedData = Comment::find($id);
            $fetchedData->delete();
            return true;
        }else{
            return false;
        }
    }
}