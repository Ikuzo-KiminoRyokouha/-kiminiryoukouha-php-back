<?php

namespace App\Board\Responders;
use Illuminate\Http\Response;


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
        }else{
            $this->response->setContent([
                'ok' =>true,
                'board' =>$board
            ]);
            $this->response->setStatusCode(Response::HTTP_OK);
        }

        return $this->response;

    }
}