<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','slug','total_cost',
        'spent_cost','available_cost','views',
        'clicks','max_time','ad_type','link',
        'ad_view','seen','approved','by_user',
    ];

    public function scopeFilter($query,$filters){
        if(isset($filters['seen'])){
            if($filters['seen']==true){
                $query->where('seen',1);
            }else{
                $query->where('seen',0);
            }
        }
        if(isset($filters['approved'])){
            if($filters['approved']==0){
                $query->where('approved',0);
            }else if($filters['approved']==1){
                $query->where('approved',1);
            }else{
                $query->where('approved',2);
            }
        }
        if(isset($filters['hideForUser'])){
            $query->where('by_user','!=',$filters['hideForUser']);
        }
        if(isset($filters['canView'])){
            $query->where('available_cost','>',0);
        }
        if(isset($filters['orderBy'])){
            $query->orderBy($filters['orderBy'],$filters['orderType']??'asc');
        }
        return $query;
    }

    public function user(){
        return $this->belongsTo(User::class,'by_user','id');
    }
}
