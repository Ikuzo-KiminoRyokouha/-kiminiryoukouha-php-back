<?php
namespace App\Board\Domain\Repositories;

use Illuminate\Http\Request;
use App\Board\Domain\Entities\Board;
use Illuminate\Support\Facades\Auth;


class CreateBoardRepository implements CreateBoardRepositoryInterface{
    public function create( $data ):bool{

        $board = Board::create([
            'title' =>$data['title'],
            'content' =>$data['content'],
            'user_id' =>Auth::user()->id,
        ]);

        if($board){
            return true;
        }else{
            return false;
        }
    }
}


