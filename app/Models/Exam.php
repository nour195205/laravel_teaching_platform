<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
    'title',
    'grade',
    'embed_code',
    'is_active',
    'start_time',
    'end_time',
];



}
