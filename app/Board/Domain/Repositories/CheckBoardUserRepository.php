<?php
namespace App\Board\Domain\Repositories;

use App\Board\Domain\Entities\Board;
use Illuminate\Support\Facades\Auth;

class CheckBoardUserRepository implements CheckBoardUserRepositoryInterface{
    public function check($id):bool{
        if(Board::where('id',$id)->withTrashed()->exists()){
            if(Auth::user()->id !==Board::where('id',$id)->withTrashed()->get('user_id')[0]->user_id ){
                return false;
            }
        }
        return true;

    }
}
