<?php
namespace App\Board\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Board\Domain\Repositories\RestoreBoardRepositoryInterface;
use App\Board\Domain\Repositories\CheckBoardUserRepositoryInterface;
use App\Common\Responders\RequestResponder;
use App\Common\Responders\CheckUserResponder;

class RestoreBoardAction extends Controller{

    protected $restoreBoard;
    protected $checkUser;
    protected $requestResponder;
    protected $checkUserResponder;

    public function __construct(
        RestoreBoardRepositoryInterface $restoreBoard,
        CheckBoardUserRepositoryInterface $checkUser,
        RequestResponder $requestResponder,
        CheckUserResponder $checkUserResponder

    ){
        $this->restoreBoard =$restoreBoard;
        $this->checkUser = $checkUser;
        $this->requestResponder = $requestResponder;
        $this->checkUserResponder = $checkUserResponder;

    }

    public function __invoke($id){
        $check = $this->checkUser->check($id);
        if($check==false){
            return $this->checkUserResponder->response();
        }

        $clear = $this->restoreBoard->restore($id);
        
        return $this->requestResponder->response($clear,"restore" , "board");
    }

}
