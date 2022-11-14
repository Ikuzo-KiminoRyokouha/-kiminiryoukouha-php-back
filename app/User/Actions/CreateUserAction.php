<?php

namespace App\User\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User\Domain\Repositories\CreateUserRepositoryInterface;
use App\Common\Responders\RequestResponder;
use App\Common\Responders\RequestValidResponder;

class CreateUserAction extends Controller{

    protected $createUser;
    protected $requestResponder;
    protected $validResponder;

    public function __construct(
        CreateUserRepositoryInterface $createUser,
        RequestResponder $requestResponder,
        RequestValidResponder $validResponder
    ){
        $this->createUser = $createUser;
        $this->requestResponder = $requestResponder;
        $this->validResponder = $validResponder;
    }

    public function __invoke(Request $request){
        $valid = \validator($request->only('name' , 'email', 'password','role'),[
            'name'=>'required|string|max:255',
            'email'=>'required|string|max:255|email',
            'password'=>'required|string|min:5',
            'role' => 'required|string|max:255',
        ]);

        if($valid->fails()){
            return $this->validResponder->response($valid);
        }


        $data = request()->only('name' , 'email', 'password', 'role');

        $check = $this->createUser->create($data);

        return $this->requestResponder->response($check,"create" , "user");
    }

}