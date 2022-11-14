<?php
namespace App\Board\Domain\Repositories;

use App\Board\Domain\Entities\Board;

class RestoreBoardRepository implements RestoreBoardRepositoryInterface{
    public function restore($id):bool{ 
        if(Board::where('id',$id)->onlyTrashed()->exists()){
            Board::withTrashed()
            ->where('id', $id)
            ->restore(); 
            return true;
        }else{
            return false;
        }

    }
}