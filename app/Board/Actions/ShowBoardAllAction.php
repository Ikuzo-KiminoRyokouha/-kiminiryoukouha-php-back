<?php
namespace App\Board\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Board\Domain\Repositories\ShowAllBoardRepositoryInterface;
use App\Board\Responders\AllBoardResponder;



class ShowBoardAllAction extends Controller{

    protected $showBoardAll;
    protected $showBoardAllResponder;

    public function __construct(
        ShowAllBoardRepositoryInterface $showBoardAll,
        AllBoardResponder $showBoardAllResponder
    ){
        $this->showBoardAll = $showBoardAll;
        $this->showBoardAllResponder = $showBoardAllResponder;
    }

    public function __invoke(Request $request ,$page){
        $data = $this->showBoardAll->show($page);
        return $this->showBoardAllResponder->response($data,$page);

    }

}