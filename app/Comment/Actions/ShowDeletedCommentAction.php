<?php
namespace App\Comment\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Comment\Domain\Repositories\ShowDeletedCommentRepositoryInterface;
use App\Comment\Responders\AllCommentResponder;



class ShowDeletedCommentAction extends Controller{

    protected $deletedComment;
    protected $showCommentAllResponder;


    public function __construct(
        ShowDeletedCommentRepositoryInterface $deletedComment,
        AllCommentResponder $showCommentAllResponder

    ){
        $this->deletedComment = $deletedComment;
        $this->showCommentAllResponder = $showCommentAllResponder;
    }

    public function __invoke(Request $request, $page){
        [$pages , $deletedComment]= $this->deletedComment->show($page);
        return $this->showCommentAllResponder->response($deletedComment,$pages,$page);

    }

}