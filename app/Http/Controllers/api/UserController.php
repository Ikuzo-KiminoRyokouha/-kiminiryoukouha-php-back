<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //
    public function show(Request $request){
        $data = $request->session()->all();
        Log::info($data);
        Log::info('-------');
        Log::info(Auth::user());
        return \response()->json([
            'user' => Auth::user()
        ],\Symfony\Component\HttpFoundation\Response::HTTP_OK);
    }

}
