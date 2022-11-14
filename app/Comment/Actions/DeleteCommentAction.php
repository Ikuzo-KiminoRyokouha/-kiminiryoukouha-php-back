<?php
namespace App\Comment\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Comment\Domain\Repositories\DeleteCommentRepositoryInterface;
use App\Comment\Domain\Repositories\CheckCommentUserRepositoryInterface;
use App\Common\Responders\RequestResponder;
use App\Common\Responders\CheckUserResponder;

class DeleteCommentAction extends Controller{

    protected $deleteComment;
    protected $chedkUser;
    protected $requestResponder;
    protected $checkUserResponder;

    public function __construct(
        DeleteCommentRepositoryInterface $deleteComment,
        CheckCommentUserRepositoryInterface $checkUser,
        RequestResponder $requestResponder,
        CheckUserResponder $checkUserResponder
    ){
        $this->deleteComment = $deleteComment;
        $this->checkUser = $checkUser;
        $this->requestResponder = $requestResponder;
        $this->checkUserResponder = $checkUserResponder;
    }

    public function __invoke(Request $reuqst, $id){
        $check = $this->checkUser->check($id);

        if($check==false){
            return $this->checkUserResponder->response();
        }

        $clear = $this->deleteComment->delete($id);

        return $this->requestResponder->response($clear,"delete" , "comment");
    }

}