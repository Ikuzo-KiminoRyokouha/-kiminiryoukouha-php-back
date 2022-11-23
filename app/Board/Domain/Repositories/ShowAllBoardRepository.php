<?php
namespace App\Board\Domain\Repositories;

use Illuminate\Http\Request;
use App\Board\Domain\Entities\Board;

class ShowAllBoardRepository implements ShowAllBoardRepositoryInterface{
    public function show($page):array{
                $board = Board::skip(($page - 1) * 6)->take(6)                    
                ->with(['user'=> function ($query) {
                    $query->select(['name','id']);
                }])
                ->get(['id' , 'title' , 'content','user_id','created_at','updated_at','private']);
        $pages = ceil(Board::count()/6);
        return [
            'pages' => $pages,
            'boards' => $board
        ];   
        
    }
}