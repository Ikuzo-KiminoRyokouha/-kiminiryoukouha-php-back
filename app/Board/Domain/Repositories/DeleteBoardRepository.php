<?php
namespace App\Board\Domain\Repositories;

use Illuminate\Http\Request;
use App\Board\Domain\Entities\Board;
use Illuminate\Support\Facades\Auth;

class DeleteBoardRepository implements DeleteBoardRepositoryInterface{
    public function delete($id):bool{
        if(Board::where('id',$id)->exists()){
            $fetchedData = Board::find($id);
            $fetchedData->delete();
            return true;
        }else  {
            return false;
        };
    }
}