<?php
namespace App\User\Responders;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class MyinfoResponder{

    protected $response;

    public function __construct(Response $response){
        $this->response = $response;
    }

    public function response($user):Response{
        if($user){
            $this->response->setContent([
                'ok' =>true,
                'user' =>$user
            ]);
            $this->response->setStatusCode(Response::HTTP_OK);
        }else{
            $this->response->setContent([
                'ok' =>false,
                'message' => 'not found user'
            ]);
            $this->response->setStatusCode(Response::HTTP_NOT_FOUND);
        }
        return $this->response;
    }

}