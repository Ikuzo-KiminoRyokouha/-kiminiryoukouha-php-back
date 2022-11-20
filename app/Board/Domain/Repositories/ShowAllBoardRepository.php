<?php
namespace App\Board\Domain\Repositories;

use Illuminate\Http\Request;
use App\Board\Domain\Entities\Board;

class ShowAllBoardRepository implements ShowAllBoardRepositoryInterface{
    public function show($page):array{
        $board = Board::skip(($page - 1) * 6)->take(6)
                ->get(['id' , 'title' , 'content','user_id','created_at','updated_at','private']);
        $pages = ceil(Board::count()/10);
        return [
            'pages' => $pages,
            'boards' => $board
        ];   
        
    }
}