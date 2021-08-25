<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassLesson extends Model
{
    protected $fillable = ['name','class_id','date','time','day','status'];

    // public function course()
    // {
    //     return $this->belongsTo(Course::class,'course_id');
    // }
    public function lessonClass()
    {
        return $this->belongsTo(Classes::class,'class_id');
    }


    public function zoomMeeting()
    {
        return $this->hasOne(ZoomMeeting::class);
    }
}
