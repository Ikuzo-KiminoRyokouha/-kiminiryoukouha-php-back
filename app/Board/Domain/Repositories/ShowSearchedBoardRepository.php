<?php
namespace App\Board\Domain\Repositories;

use App\Board\Domain\Entities\Board;

class ShowSearchedBoardRepository implements ShowSearchedBoardRepositoryInterface{
    public function show($searchItem ,$page){
        $filterData = Board::where('title','LIKE','%'.$searchItem.'%')
                            ->with(['user'=> function ($query) {
                                $query->select(['name','id']);
                            }])
                            ->skip(($page - 1) * 10)->take(10)
                            ->get(['id' , 'title' , 'content','user_id','created_at','updated_at','private','complete']);
        $pages = ceil(Board::where('title','LIKE','%'.$searchItem.'%')->count()/10);

        return [
            'pages' => $pages,
            'boards' => $filterData
        ];
    }
}