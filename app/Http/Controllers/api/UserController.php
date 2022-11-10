<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //
    public function myInfo(Request $request){
        return \response()->json([
            'user' => Auth::user()->only("email" , "name", "role" , "created_at")
        ],\Symfony\Component\HttpFoundation\Response::HTTP_OK);
    }

}
