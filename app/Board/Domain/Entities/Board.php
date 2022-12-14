<?php

namespace App\Board\Domain\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\User\Domain\Entities\User;

class Board extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['title','content','created_at','updated_at','user_id','private','password'];
    protected $primaryKey = 'id';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    
}
 

