<?php

namespace App\User\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class LogoutAction extends Controller{

    public function __invoke(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return \response()->json([
            'message'=>'compelete logout'
        ],RESPONSE::HTTP_OK);
    }

}