<?php
namespace App\Comment\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Comment\Domain\Repositories\UpdateCommentRepositoryInterface;
use App\Comment\Domain\Repositories\CheckCommentUserRepositoryInterface;
use App\Common\Responders\RequestResponder;
use App\Common\Responders\CheckUserResponder;

class UpdateCommentAction extends Controller{
    protected $updateComment;
    protected $checkUser;
    protected $requestResponder;
    protected $checkUserResponder;

    public function __construct(
        UpdateCommentRepositoryInterface $updateComment,
        CheckCommentUserRepositoryInterface $checkUser,
        RequestResponder $requestResponder,
        CheckUserResponder $checkUserResponder
    ){
        $this->updateComment = $updateComment;
        $this->checkUser = $checkUser;
        $this->requestResponder = $requestResponder;
        $this->checkUserResponder = $checkUserResponder;
    }

    public function __invoke(Request $request, $id){
        $valid = \validator($request->only('content','board_id'),[
            'content' => 'required|string',
        ]);

        if($valid->fails()){
            return $this->validResponder->response($valid);
        }

        $check = $this->checkUser->check($id);
        if($check==false){
            return $this->checkUserResponder->response();
        }

        $clear =$this->updateComment->update($request,$id);

        return $this->requestResponder->response($clear,"update" , "comment");


    }
}
