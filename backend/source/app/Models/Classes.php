<?php

namespace App\Models;

use App\Course;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'classes';

    protected $fillable = ["student_id", "teacher_id", "course_id", "start_from", "weeks", "session_time", 'free', 'private'];

    public function lessons()
    {
        return $this->hasMany(ClassLesson::class, 'class_id')->orderBy('date');
    }
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id')->withTrashed();
    }
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id')->withTrashed();
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id')->withTrashed();
    }
    public function questions()
    {
        return $this->hasMany(Question::class, 'course_id');
    }
    
}
