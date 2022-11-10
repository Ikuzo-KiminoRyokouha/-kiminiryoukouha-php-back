<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Board;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class BoardController extends Controller
{
    //
    public function create(Request $request){
        $valid = validator($request->only('title' , 'content'),[
            'title' =>'required|string|max:255',
            'content'=> 'required|string',
        ]);

        if($valid->fails()){
            return response()->json([
                'error' => $valid->errors()->all()
            ],RESPONSE::HTTP_BAD_REQUEST);
        }

        $data = request()->only('title', 'content');

        $user = Board::create([
            'title' =>$data['title'],
            'content' =>$data['content'],
            'user_id' =>Auth::user()->id,
        ]);

        Log::info(Auth::user()->id);

        return response()->json([
            'message' => 'create board',
        ],RESPONSE::HTTP_CREATED);
    
    }

    public function show(Request $request){
        $board_id = $request->id;
        $board = Board::where('id',$board_id)
                        ->with(['user'=> function ($query) {
                            $query->select(['name','id']);
                        }])
                        ->get(['id' , 'title' , 'content','user_id','created_at','updated_at']);
        return response()->json([
            $board
        ],RESPONSE::HTTP_OK);
    }

    public function showAll(Request $request){
        $page = $request->page;
        $board = DB::table('boards')->skip(($page - 1) * 10)->take(10)->get(['id' , 'title' , 'content','user_id','created_at','updated_at']);
        return response()->json([
            $board
        ],RESPONSE::HTTP_OK);
    }

    public function update(Request $request, $id){
        if(Auth::user()->id !==Board::where('id',$id)->get('user_id')[0]->user_id ){
            return response()->json([
                "message" => "you can not update this notice"
            ],RESPONSE::HTTP_FORBIDDEN);
        }
        if(Board::where('id',$id)->exists()){
            $fetchedData = Board::find($id);
            $fetchedData->update($request->all());
            return response()->json([
                "message" => "completed update"
            ],RESPONSE::HTTP_OK);
        }else{
            return response()->json([
                "message"=>"There is no previous"
            ],RESPONSE::HTTP_BAD_REQUEST);
        }
    }

    public function delete(Request $request , $id){

        if(Auth::user()->id !==Board::where('id',$id)->get('user_id')[0]->user_id ){
            return response()->json([
                "message" => "you can not update this notice"
            ],RESPONSE::HTTP_FORBIDDEN);
        }

        if(Board::where('id',$id)->exists()){
            $fetchedData = Board::find($id);
            $fetchedData->delete();

            return response()->json([
                "message"=>"complete destroy"
            ],RESPONSE::HTTP_OK);;
        }else{
            return response()->json([
                "message"=>"Not found id=${id} notice"
            ],RESPONSE::HTTP_NOT_FOUND);
        }
    }

}
