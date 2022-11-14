<?php
namespace App\Board\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Board\Domain\Repositories\ShowDeletedBoardRepositoryInterface;
use App\Board\Responders\AllBoardResponder;


class ShowDeletedBoardAction extends Controller{

    protected $ShowDeletedBaord;
    protected $showBoardAllResponder;

    public function __construct(
        ShowDeletedBoardRepositoryInterface $ShowDeletedBaord,
        AllBoardResponder $showBoardAllResponder
    ){
        $this->showDeletedBaord = $ShowDeletedBaord;
        $this->showBoardAllResponder = $showBoardAllResponder;
    }

    public function __invoke(Request $request , $page){

        $data = $this->showDeletedBaord->show($page);

        return $this->showBoardAllResponder->response($data ,$page);


    }

}