<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	protected $table = 'answers';


    protected $fillable = [
    'answer','question_id'
];




   public function question(){
       return $this->belongsTo(Question::class, 'question_id');
   }


}
