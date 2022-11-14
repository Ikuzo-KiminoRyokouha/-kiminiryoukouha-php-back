<?php
namespace App\Comment\Domain\Repositories;

use App\Comment\Domain\Entities\Comment;
use Illuminate\Support\Facades\Auth;

class ShowCommentsRepository implements ShowCommentsRepositoryInterface{
    public function show($board_id, $page):array{
        $pages = ceil(Comment::where('board_id',$board_id)->count()/10);
        $comments = Comment::where('board_id',$board_id)
                ->skip(($page - 1) * 10)->take(10)
                ->with([
                    'user'=>function ($query){
                        $query->select(['id', 'name']);
                     },
                    'targetUser' =>function($query){
                        $query->select(['id','name']);
                    }])
                ->get(['id' , 'content' , 'user_id' , 'group' , 'target_id'])
                ->groupBy('group');

        return [
            $pages,
            $comments
        ];
    }
}