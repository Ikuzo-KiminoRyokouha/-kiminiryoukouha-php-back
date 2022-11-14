<?php
namespace App\Board\Domain\Repositories;

use Illuminate\Http\Request;
use App\Board\Domain\Entities\Board;

class ShowAllBoardRepository implements ShowAllBoardRepositoryInterface{
    public function show($page):array{
        $board = Board::skip(($page - 1) * 10)->take(10)
                ->get(['id' , 'title' , 'content','user_id','created_at','updated_at']);
        $pages = ceil(Board::count()/10);
        return [
            'pages' => $pages,
            'boards' => $board
        ];   
        
    }
}