<?php

namespace App\User\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Common\Responders\RequestValidResponder;
use App\Common\Responders\RequestResponder;



class LoginAction extends Controller{

    protected $requestResponder;
    protected $validResponder;
    
    public function __construct(       
        RequestValidResponder $validResponder,
        RequestResponder $requestResponder,
    ){
        $this->requestResponder = $requestResponder;
        $this->validResponder = $validResponder;
    }


    public function __invoke(Request $request){
        $loginCredential =  validator($request->only('email' , 'password'),[
            'email'=>'required|string|max:255|email',
            'password'=>'required|string|min:5',
        ]);

        if($loginCredential->fails()){
            return $this->validResponder->response($loginCredential);
        }

        $loginCredential = request()->only('email', 'password');

        if (Auth::attempt($loginCredential)) {
            $request->session()->put('key',$loginCredential['email']);
            return $this->requestResponder->response(true,"login" , "user");
        }
        return $this->requestResponder->response(false,"login" , "user");
        
 

    }

}