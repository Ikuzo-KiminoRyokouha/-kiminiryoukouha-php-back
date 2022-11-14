<?php

namespace App\Comment\Responders;

use Illuminate\Http\Response;


class AllCommentResponder{

    protected $reponse;

    public function __construct(Response $response){
        $this->response = $response;
    }

    public function response($comments,$pages,$page):Response{
        if($pages==0||$page >$pages){
            $this->response->setContent([
                'ok' =>false,
                'message' => 'not found board'
            ]);
            $this->response->setStatusCode(Response::HTTP_NOT_FOUND);
        }else{
            $this->response->setContent([
                'ok' =>true,
                'pages' =>$pages,
                'comments' =>$comments
            ]);
            $this->response->setStatusCode(Response::HTTP_OK);
        }

        return $this->response;

    }
}