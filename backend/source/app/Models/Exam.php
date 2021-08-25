<?php

namespace App\Models;

use App\Course;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //
    protected $guarded = [];

    public function sections()
    {
        return $this->hasMany(ExamSection::class, 'exam_id');
    }


    public function courses(){
        return $this->belongsToMany(Course::class ,'exam_relation');
    }
    public function chapters(){
        return $this->belongsToMany(Chapter::class ,'exam_relation');
    }
    public function lessons(){
        return $this->belongsToMany(Lesson::class ,'exam_relation');
    }
    public function classes(){
        return $this->belongsToMany(Classes::class ,'exam_relation');
    }

    public function students(){
        return $this->hasMany(StudentExams::class);
    }
}
