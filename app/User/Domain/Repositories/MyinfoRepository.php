<?php
namespace App\User\Domain\Repositories;

use Illuminate\Http\Request;
use App\User\Domain\Entities\User;
use Illuminate\Support\Facades\Auth;


class MyinfoRepository implements MyinfoRepositoryInterface{
    public function show():object{
        if(Auth::user()==true){
            $user = User::where('email',Auth::user()->email)
                    ->get(['name','created_at','email','role']);
            return $user;
        }else{
            return NULL;
        }
    }
}