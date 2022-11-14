<?php
namespace App\Comment\Domain\Repositories;

use App\Comment\Domain\Entities\Comment;
use Illuminate\Support\Facades\Auth;


class CheckCommentUserRepository implements CheckCommentUserRepositoryInterface{
    public function check($id):bool{
        if(Comment::where('id',$id)->withTrashed()->exists()){
            if(Auth::user()->id !==Comment::where('id',$id)->withTrashed()->get('user_id')[0]->user_id ){
                return false;
            }
        }
        return true;
    }
}
