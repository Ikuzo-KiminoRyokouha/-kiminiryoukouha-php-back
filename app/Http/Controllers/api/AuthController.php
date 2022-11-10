<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;




class AuthController extends Controller
{
    //
    public function register(Request $request){
        $valid = \validator($request->only('name' , 'email', 'password','role'),[
            'name'=>'required|string|max:255',
            'email'=>'required|string|max:255|email',
            'password'=>'required|string|min:5',
            'role' => 'required|string|max:255',
        ]);

        if($valid->fails()){
            return response()->json([
                'error' => $valid->errors()->all()
            ],RESPONSE::HTTP_BAD_REQUEST);
        }

        $data = request()->only('name' , 'email', 'password', 'role');

        $user = User::create([
            'name' =>$data['name'],
            'email' =>$data['email'],
            'password' =>bcrypt($data['password']),
            'role' =>$data['role'],
        ]);

        return response()->json([
            'message' => "sign up is complete",
            'user' =>$user->name,
        ],RESPONSE::HTTP_CREATED);
    }

    public function login(Request $request){
        $loginCredential = $request->validate([
            'email'=>'required|string|max:255|email',
            'password'=>'required|string|min:5',
        ]);
        Log::info(date("Y-m-d H:i:s"));


        if (Auth::attempt($loginCredential)) {
            $request->session()->put('key',$loginCredential['email']);
            return \response()->json([
                'message' => 'complete login'
            ],RESPONSE::HTTP_OK);
        }
 
        return response()->json([
            'message'=>'Invalid login information'
        ],RESPONSE::HTTP_UNAUTHORIZED);
    }   

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return \response()->json([
            'session'=>Auth::user()
        ],RESPONSE::HTTP_OK);
    }

    public function checkDuplicateEmail(Request $request){
        $valid = \validator($request->only('check_duplicate'),[
            'check_duplicate'=>'required|string|max:255|email',
        ]);

        if($valid->fails()){
            return response()->json([
                'error' => $valid->errors()->all()
            ],RESPONSE::HTTP_BAD_REQUEST);
        }

        $data = \request()->only('check_duplicate');

        $check = true;

        if(User::where('email',$data['check_duplicate'])->exists()){
            $check = false;
        }
        Log::info('chekc');

        return response()->json([
            $check
        ],RESPONSE::HTTP_OK);
    }

    
}
