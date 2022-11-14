<?php
namespace App\Comment\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Comment\Domain\Repositories\ShowCommentsRepositoryInterface;
use App\Comment\Responders\AllCommentResponder;


class ShowCommentsAction extends Controller{
    protected $showComments;
    protected $showCommentAllResponder;

    public function __construct(
        ShowCommentsRepositoryInterface $showComments,
        AllCommentResponder $showCommentAllResponder
    ){
        $this->showComments = $showComments;
        $this->showCommentAllResponder = $showCommentAllResponder;
    }

    public function __invoke(Request $request, $board_id, $page){
        [$pages , $comments] =  $this->showComments->show($board_id, $page);

        return $this->showCommentAllResponder->response($comments,$pages,$page);

    }
}