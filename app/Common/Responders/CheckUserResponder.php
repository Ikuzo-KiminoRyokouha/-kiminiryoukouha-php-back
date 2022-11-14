<?php

namespace App\Common\Responders;
use Illuminate\Http\Response;


class CheckUserResponder{

    protected $reponse;

    public function __construct(Response $response){
        $this->response = $response;
    }

    public function response():Response{
        $this->response->setContent([
            'ok' =>false,
            'message' => "you can not delete this notice",
        ]);
        $this->response->setStatusCode(Response::HTTP_FORBIDDEN);
        return $this->response;
    }
}