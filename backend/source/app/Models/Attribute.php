<?php

namespace App\Models;

use App\CategoryCourse;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Attribute extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $fillable = ['name','category_id'];

    public function category (){
        return $this->belongsTo(CategoryCourse::class,'category_id');
    }
}
