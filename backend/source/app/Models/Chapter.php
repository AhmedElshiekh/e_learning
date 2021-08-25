<?php

namespace App\Models;

use App\Course;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Chapter extends Model
{
    use HasTranslations;

    public $translatable = ['name'];
    protected $fillable = ['name','price','course_id'];


    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'chapter_id');
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'chapter_id');
    }

    public function exam()
    {
        return $this->belongsToMany(Exam::class ,'exam_relation');
    }
}
