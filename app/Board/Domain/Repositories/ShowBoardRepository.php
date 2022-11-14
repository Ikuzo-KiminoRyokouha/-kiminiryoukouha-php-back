<?php

namespace App\Board\Domain\Repositories;

use App\Board\Domain\Entities\Board;

class ShowBoardRepository implements ShowBoardRepositoryInterface{

    public function show($board_id): object {
        $board = Board::where('id',$board_id)
                    ->with(['user'=> function ($query) {
                        $query->select(['name','id']);
                    }])
                     ->get(['id' , 'title' , 'content','user_id','created_at','updated_at']);
        
        return $board;
    }

}