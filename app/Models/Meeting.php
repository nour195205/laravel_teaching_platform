<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'title',
        'grade',
        'embed_code',
        'start_time',
        'is_active',
    ];

    protected $dates = ['start_time'];
}
