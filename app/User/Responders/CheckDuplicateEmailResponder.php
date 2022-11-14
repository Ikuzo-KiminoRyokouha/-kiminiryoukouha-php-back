<?php

namespace App\User\Responders;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;



class CheckDuplicateEmailResponder{

    protected $reponse;

    public function __construct(Response $response){
        $this->response = $response;
    }

    public function response($check):Response{
        if($check){
            $this->response->setContent([
                'ok' =>true,
                'message' => "not duplicate",
            ]);
            $this->response->setStatusCode(Response::HTTP_OK);
        }else{
            $this->response->setContent([
                'ok' =>false,
                'message' => "duplicate",
            ]);
            $this->response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
        return $this->response;

    }
}