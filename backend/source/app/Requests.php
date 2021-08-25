<?php

namespace App;

use App\Models\Classes;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $fillable = [
        'course_id', 'teacher_id', 'start_date', 'user_id', 'note', 'views', 'sat', 'sun', 'mon', 'tue', 'wed', 'thu', 'fri'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
