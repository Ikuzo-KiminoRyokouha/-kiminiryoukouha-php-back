<?php

namespace App\Board\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Board\Domain\Repositories\ShowBoardRepositoryInterface;
use App\Board\Responders\BoardResponder;

class ShowBoardAction extends Controller{
    protected $showBoard;
    protected $showBoardResponder;

    public function __construct(
        ShowBoardRepositoryInterface $showBoard,
        BoardResponder $showBoardResponder
    ){
        $this->showBoard = $showBoard;
        $this->showBoardResponder = $showBoardResponder;
    }

    public function __invoke(Request $request, $board_id){
        $board = $this->showBoard->show($board_id);
        return $this->showBoardResponder->response($board);
    }
}