<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;


class CommentController extends Controller
{
    //
    public function create(Request $request){
        $data = request()->all();
        $comment = Comment::create([
            'content' => $data['content'],
            'user_id' => Auth::user()->id,
            'board_id' => $data['board_id'],     
            'target_id'=>$data['target_id'],
            'group' => $data['group']
        ]);
        if($request->group == null){
            Comment::where('id',$comment->id)->update(['group'=>$comment->id]);
        }
    }

    public function show(Request $request){
        $comment = Comment::with([
                    'user'=>function ($query){
                        $query->select(['id', 'name']);
                     },
                    'targetUser' =>function($query){
                        $query->select(['id','name']);
                    }])
                ->get(['id' , 'content' , 'user_id' , 'group' , 'target_id'])
                ->groupBy('group');
       
        return response()->json([
            $comment
        ],RESPONSE::HTTP_OK);
    }

    public function update(Request $request , $id){
        Log::info($request->all());
        
        if(Auth::user()->id !==Comment::where('id',$id)->get('user_id')[0]->user_id ){
            return response()->json([
                "message" => "you can not update this notice"
            ],RESPONSE::HTTP_FORBIDDEN);
        }

        if(Comment::where('id' ,$id)->exists()){
            Log::info($request);
            $fetchdData = Comment::find($id);
            $fetchdData->update($request->all());
            Log::info($fetchdData);
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
        if(Auth::user()->id !==Comment::where('id',$id)->get('user_id')[0]->user_id ){
            return response()->json([
                "message" => "you can not update this notice"
            ],RESPONSE::HTTP_FORBIDDEN);
        }
    }


}
