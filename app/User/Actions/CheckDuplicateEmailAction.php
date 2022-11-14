<?php

namespace App\User\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User\Domain\Repositories\CheckDuplicateEmailRepositoryInterface;
use App\Common\Responders\RequestValidResponder;
use App\User\Responders\CheckDuplicateEmailResponder;


class CheckDuplicateEmailAction extends Controller{

    protected $checkEmail;
    protected $validResponder;
    protected $duplicateEmailResponder;

    public function __construct(
        CheckDuplicateEmailRepositoryInterface $checkEmail,
        RequestValidResponder $validResponder,
        CheckDuplicateEmailResponder $duplicateEmailResponder

    ){
        $this->checkEmail = $checkEmail;
        $this->validResponder = $validResponder;
        $this->duplicateEmailResponder = $duplicateEmailResponder;
    }

    public function __invoke(Request $request){
        $valid = \validator($request->only('check_duplicate'),[
            'check_duplicate'=>'required|string|max:255|email',
        ]);


        if($valid->fails()){
            return $this->validResponder->response($valid);
        }

        $data = \request()->only('check_duplicate');

        $check = $this->checkEmail->check($data);
        
        return $this->duplicateEmailResponder->response($check);
        
    }
}