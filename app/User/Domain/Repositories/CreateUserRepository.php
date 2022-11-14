<?php

namespace App\User\Domain\Repositories;

use App\User\Domain\Entities\User;

class CreateUserRepository implements CreateUserRepositoryInterface{
    public function create( $data ):bool{
        if(User::where('email',$data['email'])->exists()){
            return false;
        }else{
            $user = User::create([
                'name' =>$data['name'],
                'email' =>$data['email'],
                'password' =>bcrypt($data['password']),
                'role' =>$data['role'],
            ]);
            return true;
        }

    }
}