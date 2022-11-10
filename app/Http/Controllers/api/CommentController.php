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


}
