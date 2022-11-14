<?php
namespace App\Board\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Board\Domain\Repositories\DeleteBoardRepositoryInterface;
use App\Board\Domain\Repositories\CheckBoardUserRepositoryInterface;
use App\Common\Responders\RequestResponder;
use App\Common\Responders\CheckUserResponder;

class DeleteBoardAction extends Controller{
    
    protected $deleteBoard;
    protected $checkUser;
    protected $requestResponder;
    protected $checkUserResponder;

    public function __construct(
        DeleteBoardRepositoryInterface $deleteBoard,
        CheckBoardUserRepositoryInterface $checkUser,
        RequestResponder $requestResponder,
        CheckUserResponder $checkUserResponder
    ){
        $this->deleteBoard = $deleteBoard;
        $this->checkUser = $checkUser;
        $this->requestResponder = $requestResponder;
        $this->checkUserResponder = $checkUserResponder;
    }

    public function __invoke(Request $request, $id){

        $check = $this->checkUser->check($id);

        if($check==false){
            return $this->checkUserResponder->response();
        }

        $clear = $this->deleteBoard->delete($id);

        return $this->requestResponder->response($clear,"delete" , "board");

    }

}