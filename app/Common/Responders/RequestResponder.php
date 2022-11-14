<?php

namespace App\Common\Responders;
use Illuminate\Http\Response;



class RequestResponder{

    protected $reponse;

    public function __construct(Response $response){
        $this->response = $response;
    }

    public function response($check,$message, $target):Response{
        if($check){
            $this->response->setContent([
                'ok' =>true,
                'message' => "{$message} {$target}",
            ]);
            $this->response->setStatusCode(Response::HTTP_OK);
        }else{
            $this->response->setContent([
                'ok' =>false,
                'message' => "fail to {$message} {$target}",
            ]);
            $this->response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
        return $this->response;

    }
}