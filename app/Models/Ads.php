<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'total_cost',
        'spent_cost',
        'available_cost',
        'views',
        'clicks',
        'max_time',
        'ad_type',
        'link',
        'ad_view',
        'by_user',
    ];
}
