<?php
namespace App\Board\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Board\Domain\Repositories\UpdateBoardRepositoryInterface;
use App\Board\Domain\Repositories\CheckBoardUserRepositoryInterface;
use App\Common\Responders\RequestResponder;
use App\Common\Responders\CheckUserResponder;

class UpdateBoardAction extends Controller{

    protected $updateBoard;
    protected $checkUser;
    protected $requestResponder;
    protected $checkUserResponder;

    public function __construct(
        UpdateBoardRepositoryInterface $updateBoard ,
        CheckBoardUserRepositoryInterface $checkUser,
        RequestResponder $requestResponder,
        CheckUserResponder $checkUserResponder
    ){
        $this->updateBoard = $updateBoard;
        $this->checkUser = $checkUser;
        $this->requestResponder = $requestResponder;
        $this->checkUserResponder = $checkUserResponder;
    }

    public function __invoke(Request $request, $id){

        $valid = validator($request->only('title' , 'content'),[
            'title' =>'required|string|max:255',
            'content'=> 'required|string',
        ]);

        if($valid->fails()){
            return $this->validResponder->response($valid);
        }

        $check = $this->checkUser->check($id);

        if($check==false){
            return $this->checkUserResponder->response();
        }

        $clear = $this->updateBoard->update($request ,$id);

        return $this->requestResponder->response($clear,"update" , "board");


    }

}