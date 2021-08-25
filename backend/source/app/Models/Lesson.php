<?php

namespace App\Models;

use App\Course;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

// use Spatie\Translatable\HasTranslations;

class Lesson extends Model
{
    protected $table = 'lessons';
    use HasTranslations;
//    use SoftDeletes;

    public $translatable = ['topic'];
    protected $fillable = [
     'slug','topic','objective', 'summary', 'material','video','free', 'course_id','chapter_id'
    ];
    public function setSlugAttribute($value){
        $this->attributes['slug'] = Str::Slug($value);
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }


    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }


    public function questions()
    {
        return $this->hasMany(Question::class, 'lesson_id');
    }

    public function exam()
    {
        return $this->belongsToMany(Exam::class,'exam_relation');
    }


}
