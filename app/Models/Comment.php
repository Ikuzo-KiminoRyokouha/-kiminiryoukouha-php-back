<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Board;


class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'content', 'group', 'sequence', 'created_at','updated_at','user_id','board_id','target_id'
    ];
    protected $primaryKey = 'id';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    public function comment(){
        return $this->belongsTo(Comment::class ,'group' , 'id' );      
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function board(){
        return $this->belongsTo(Board::class,'board_id','id');
    }
    public function targetUser(){
        return $this->belongsTo(User::class ,'target_id' , 'id' );      
    }
}
