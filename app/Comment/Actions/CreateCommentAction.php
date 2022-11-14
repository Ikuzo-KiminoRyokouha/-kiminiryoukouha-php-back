<?php
namespace App\Comment\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Comment\Domain\Repositories\CreateCommentRepositoryInterface;
use App\Common\Responders\RequestResponder;
use App\Common\Responders\RequestValidResponder;

class CreateCommentAction extends Controller{
    protected $createComment;
    protected $requestResponder;
    protected $validResponder;

    public function __construct(
        CreateCommentRepositoryInterface $createComment,
        RequestResponder $requestResponder,
        RequestValidResponder $validResponder
    ){
        $this->createComment = $createComment;
        $this->requestResponder = $requestResponder;
        $this->validResponder = $validResponder;
    }

    public function __invoke(Request $request){
        $valid = \validator($request->only('content','board_id'),[
            'content' => 'required|string',
            'board_id' =>'required|string|max:255',
        ]);
        
        if($valid->fails()){
            return $this->validResponder->response($valid);
        }

        $data = request()->only('content','user_id','board_id' , 'target_id','group');
        $check = $this->createComment->create($data);

        return $this->requestResponder->response($check,"create" , "comment");

    }
}