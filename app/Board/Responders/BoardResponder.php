<?php

namespace App\Board\Responders;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class BoardResponder{

    protected $reponse;

    public function __construct(Response $response){
        $this->response = $response;
    }

    public function response($board):Response{
        if(empty($board[0])==true){
            $this->response->setContent([
                'ok' =>false,
                'message' => 'not found board'
            ]);
            $this->response->setStatusCode(Response::HTTP_NOT_FOUND);
        }else if($board[0]->user->id == Auth::user()->id || Auth::user()->role =="manager"){
            $this->response->setContent([
                'ok' =>true,
                'board' =>$board
            ]);
            $this->response->setStatusCode(Response::HTTP_OK);
        }else if(($board[0]->private == true && $board[0]->user->id !== Auth::user()->id)){
            $this->response->setContent([
                'ok' =>false,
                'message' => 'you can not access this content'
            ]);
            $this->response->setStatusCode(Response::HTTP_FORBIDDEN);
        }else{
            $this->response->setContent([
                'ok' =>false,
                'message' => 'error'
            ]);
        }

        return $this->response;

    }
}