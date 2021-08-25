<?php

namespace App;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Plank\Mediable\Mediable;
use Spatie\Translatable\HasTranslations;

class CategoryCourse extends Model
{
    protected $table = 'category_courses';

    use Mediable;
    use HasTranslations;
    public $translatable = ['name','desc'];
    protected $fillable =['slug', 'level'];

    public function setSlugAttribute($value){
        $this->attributes['slug'] = Str::Slug($value);
    }
    public function courses(){
        return $this->hasMany(Course::class,'course_cat_id');
    }

    public function children() {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function parent() {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }
    public function users()
    {
        return $this->belongsToMany(Admin::class, 'user_categories','category_id','user_id');
    }




}
