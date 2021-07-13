<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $fillable=['user_id','amount','reason','request_id','method','seen'];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
