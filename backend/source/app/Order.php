<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    // protected $fillable = [
    //     'status', 'date', 'time', 'user_id', 'course_id','total'
    // ];


    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // public function teacher()
    // {
    //     return $this->belongsTo(User::class, 'teacher_id');
    // }
}
