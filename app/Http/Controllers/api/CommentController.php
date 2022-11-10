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
        $valid = \validator($request->only('content','board_id'),[
            'content' => 'required|string',
            'board_id' =>'required|string|max:255',
        ]);

        if($valid->fails()){
            return response()->json([
                'error' => $valid->errors()->all()
            ],RESPONSE::HTTP_BAD_REQUEST);
        }

        $data = request()->only('content','user_id','board_id' , 'target_id','group');
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

        return response()->json([
            "messge" => "create a comment"
        ],RESPONSE::HTTP_OK);
    }

    public function show(Request $request, $board_id, $page){
        $pages = ceil(Comment::where('board_id',$board_id)->count()/10);
        $comment = Comment::where('board_id',$board_id)
                ->skip(($page - 1) * 10)->take(10)
                ->with([
                    'user'=>function ($query){
                        $query->select(['id', 'name']);
                     },
                    'targetUser' =>function($query){
                        $query->select(['id','name']);
                    }])
                ->get(['id' , 'content' , 'user_id' , 'group' , 'target_id'])
                ->groupBy('group');
       
        return response()->json([
            $pages,
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

        if(Comment::where('id',$id)->exists()){
            $fetchedData = Comment::find($id);
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

    public function deletedComment(Request $request , $page){
        $pages = ceil(Comment::where('user_id', Auth::user()->id)->onlyTrashed()->count()/10);
        $deletedBoard = Comment::where('user_id', Auth::user()->id)
                        ->skip(($page - 1) * 10)->take(10)
                        ->with([
                            'user'=>function ($query){
                                $query->select(['id', 'name']);
                             },
                            'targetUser' =>function($query){
                                $query->select(['id','name']);
                            }])
                        ->onlyTrashed()
                        ->get(['id' , 'content' , 'user_id' , 'target_id']);
        return response()->json([
            $pages,
            $deletedBoard
        ],RESPONSE::HTTP_OK);
    }


}
