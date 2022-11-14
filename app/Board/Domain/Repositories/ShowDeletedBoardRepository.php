<?php
namespace App\Board\Domain\Repositories;

use Illuminate\Http\Request;
use App\Board\Domain\Entities\Board;
use Illuminate\Support\Facades\Auth;

class ShowDeletedBoardRepository implements ShowDeletedBoardRepositoryInterface{
    public function show($page):array{
        $deletedBoard = Board::where('user_id', Auth::user()->id)
                        ->skip(($page - 1) * 10)->take(10)
                        ->onlyTrashed()->get(['id','title' , 'content','user_id','created_at','deleted_at']);
        $pages = ceil(Board::where('user_id', Auth::user()->id)->onlyTrashed()->count()/10);

        return [
            'pages' => $pages,
            'boards' => $deletedBoard
        ];
    }
}