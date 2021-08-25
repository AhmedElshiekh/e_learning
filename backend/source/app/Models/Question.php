<?php

namespace App\Models;

use App\Models\Answer;
use App\CategoryCourse;
use App\Course;
use App\Level;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'title', 'correct_answer', 'lesson_id','course_id','chapter_id'
       ];



    public function answers(){
        return $this->hasMany(Answer::class, 'question_id');
    }

    public function correctAnswer(){
        return $this->belongsTo(Answer::class, 'correct_answer');
    }
    public function category()
    {
        return $this->belongsTo(CategoryCourse::class, 'category_id');
    }
    public function parentCategory()
    {
        return $this->belongsTo(CategoryCourse::class, 'parent_cat_id');
    }
    public function subCategory()
    {
        return $this->belongsTo(CategoryCourse::class, 'sub_cat_id');
    }
    public function level()
    {
        return $this->belongsTo(Level::class);
    }


    public function examSections(){
        return $this->belongsToMany(ExamSection::class ,'section_questions','question_id','section_id');
    }

}
