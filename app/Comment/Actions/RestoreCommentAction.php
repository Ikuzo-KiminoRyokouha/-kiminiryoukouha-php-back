<?php
namespace App\Comment\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Comment\Domain\Repositories\RestoreCommentRepositoryInterface;
use App\Comment\Domain\Repositories\CheckCommentUserRepositoryInterface;
use App\Common\Responders\RequestResponder;
use App\Common\Responders\CheckUserResponder;

class RestorecommentAction extends Controller{

    protected $restoreCommnet;
    protected $chedkUser;
    protected $requestResponder;
    protected $checkUserResponder;

    public function __construct(
        RestoreCommentRepositoryInterface $restoreCommnet,
        CheckCommentUserRepositoryInterface $checkUser,
        RequestResponder $requestResponder,
        CheckUserResponder $checkUserResponder
    ){
        $this->restoreComment =$restoreCommnet;
        $this->checkUser = $checkUser;
        $this->requestResponder = $requestResponder;
        $this->checkUserResponder = $checkUserResponder;
    }

    public function __invoke($id){
        $check = $this->checkUser->check($id);
        if($check==false){
            return $this->checkUserResponder->response();
        }

        $clear = $this->restoreComment->restore($id);
        
        return $this->requestResponder->response($clear,"restore" , "comment");
    }

}
