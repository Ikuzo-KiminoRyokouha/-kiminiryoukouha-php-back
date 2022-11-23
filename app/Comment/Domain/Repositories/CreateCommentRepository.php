<?php
namespace App\Comment\Domain\Repositories;

use App\Comment\Domain\Entities\Comment;
use App\Board\Domain\Entities\Board;
use Illuminate\Support\Facades\Auth;

class CreateCommentRepository implements CreateCommentRepositoryInterface{
    public function create($data):bool{
        $comment = Comment::create([
            'content' => $data['content'],
            'user_id' => Auth::user()->id,
            'board_id' => $data['board_id'],     
            'target_id'=>$data['target_id'],
            'group' => $data['group']
        ]);
        if(Auth::user()->role==='manager'){
            $board = Board::where('id',$data['board_id'])->update(['complete'=>true]);
        }

        if($data['group'] == null){
            Comment::where('id',$comment->id)->update(['group'=>$comment->id]);
        }

        if($comment){
            return true;
        }else{
            return false;
        }
    }
}