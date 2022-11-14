<?php

namespace App\User\Domain\Repositories;


use Illuminate\Http\Request;
use App\User\Domain\Entities\User;

class CheckDuplicateEmailRepository implements CheckDuplicateEmailRepositoryInterface{
    public function check( $data, ):bool{
        if(User::where('email',$data['check_duplicate'])->exists()){
            return false;
        }
        return true;

    }
}