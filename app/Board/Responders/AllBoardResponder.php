<?php

namespace App\Board\Responders;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;


class AllBoardResponder{

    protected $reponse;

    public function __construct(Response $response){
        $this->response = $response;
    }

    public function response($boards,$page):Response{

        if($boards['pages']==0||$page >$boards['pages']){
            $this->response->setContent([
                'ok' =>false,
                'message' => 'not found board'
            ]);
            $this->response->setStatusCode(Response::HTTP_NOT_FOUND);
        }else{
            $this->response->setContent([
                'ok' =>true,
                'pages' =>$boards['pages'],
                'boards' =>$boards['boards']
            ]);
            $this->response->setStatusCode(Response::HTTP_OK);
        }

        return $this->response;

    }
}