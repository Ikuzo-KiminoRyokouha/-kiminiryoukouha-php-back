<?php

namespace App\Common\Responders;
use Illuminate\Http\Response;


class RequestValidResponder{

    protected $reponse;

    public function __construct(Response $response){
        $this->response = $response;
    }

    public function response($check):Response{
        $this->response->setContent([
            'ok' =>false,
            'message' => 'check what you wrote ',
        ]);
        $this->response->setStatusCode(Response::HTTP_BAD_REQUEST);

        return $this->response;
    }

}


