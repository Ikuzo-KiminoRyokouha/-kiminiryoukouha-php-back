<?php
namespace App\Board\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Board\Domain\Repositories\ShowSearchedBoardRepositoryInterface;
use App\Board\Responders\AllBoardResponder;

class ShowSearchedBoardAction extends Controller{
    protected $showSearchedBoard;
    protected $showBoardAllResponder;

    public function __construct(
        ShowSearchedBoardRepositoryInterface $showSearchedBoard,
        AllBoardResponder $showBoardAllResponder
    ){
        $this->showSearchedBoard = $showSearchedBoard;
        $this->showBoardAllResponder = $showBoardAllResponder;
    }

    public function __invoke(Request $reqeust , $searchItem, $page){
        $data = $this->showSearchedBoard->show($searchItem,$page);
        return $this->showBoardAllResponder->response($data ,$page);


    }
}