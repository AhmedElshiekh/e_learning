<?php

namespace App;

use App\Models\Chapter;
use App\Models\Classes;
use App\Models\Exam;
use App\Models\Lesson;
use App\Models\ProductAttribute;
use App\Models\ProductVariation;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Plank\Mediable\Mediable;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Carbon;

class Course extends Model
{
    use Mediable;
    use HasTranslations;
    use SoftDeletes;
    public $translatable = ['name', 'sh_desc'];
    protected $fillable = ['slug', 'status', 'placementTest_id'];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::Slug($value);
    }

    public function categoryCourse()
    {
        return $this->belongsTo(CategoryCourse::class, 'course_cat_id');
    }
    public function parentCategory()
    {
        return $this->belongsTo(CategoryCourse::class, 'parent_cat_id');
    }
    public function subCategory()
    {
        return $this->belongsTo(CategoryCourse::class, 'sub_cat_id');
    }
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function classes()
    {
        return $this->hasMany(Classes::class, 'course_id')->orderBy('created_at', 'desc');
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id');
    }
    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'course_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class, 'course_id');
    }
    public function teachers()
    {
        return $this->belongsToMany(User::class, 'teacher_courses', 'course_id', 'user_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function exam()
    {
        return $this->hasOne(Exam::class, 'exam_id');
    }

    public function getDiscountAttribute()
    {
        if ($this->start_date < Carbon::now()->format('Y-m-d H:i:s') && $this->end_date > Carbon::now()->format('Y-m-d H:i:s')) {
            return $this->discountPrice;
        } else {
            return 0;
        }
    }

    public function placementTest()
    {
        return $this->hasOne(Exam::class, 'placementTest_id');
    }

    public function requests()
    {
        return $this->hasMany(Requests::class );
    }

    public function students()
    {
        return $this->belongsToMany(User::class);
    }

}
