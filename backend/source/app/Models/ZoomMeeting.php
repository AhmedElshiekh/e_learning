<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomMeeting extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function lesson()
    {
        return $this->belongsTo(ClassLesson::class,'class_lesson_id');
    }
}
