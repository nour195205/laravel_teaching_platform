<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    // app/Models/Lesson.php

    protected $fillable = [
        'title',
        'description',
        'grade',
        'video_url',
        'attachment'
    ];


}
