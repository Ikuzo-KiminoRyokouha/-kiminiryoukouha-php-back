<?php
namespace App\Comment\Domain\Repositories;

use App\Comment\Domain\Entities\Comment;
use Illuminate\Support\Facades\Auth;

class ShowDeletedCommentRepository implements  ShowDeletedCommentRepositoryInterface{
    public function show($page):array{
        $pages = ceil(Comment::where('user_id', Auth::user()->id)->onlyTrashed()->count()/10);
        $deletedBoard = Comment::where('user_id', Auth::user()->id)
                        ->skip(($page - 1) * 10)->take(10)
                        ->with([
                            'user'=>function ($query){
                                $query->select(['id', 'name']);
                             },
                            'targetUser' =>function($query){
                                $query->select(['id','name']);
                            }])
                        ->onlyTrashed()
                        ->get(['id' , 'content' , 'user_id' , 'target_id']);
        return [
            $pages,
            $deletedBoard
        ];
    }
}