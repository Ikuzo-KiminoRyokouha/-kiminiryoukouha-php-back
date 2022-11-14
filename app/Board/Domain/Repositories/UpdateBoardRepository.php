<?php
namespace App\Board\Domain\Repositories;

use Illuminate\Http\Request;
use App\Board\Domain\Entities\Board;
use Illuminate\Support\Facades\Auth;

class UpdateBoardRepository implements UpdateBoardRepositoryInterface{
    public function update($request , $id):bool{
        if(Board::where('id',$id)->exists()){
            $fetchedData = Board::find($id);
            $fetchedData->update($request->all());
            return true;
        }else{
            return false;
        }
    }
}