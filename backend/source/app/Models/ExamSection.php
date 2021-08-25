<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSection extends Model
{

    public function exam()
    {
        return $this->belongsTo(Exam::class,'exam_id');
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'section_questions','section_id','question_id');
    }

    public function studentExam()
    {
        return $this->hasOne(StudentSectionExam::class);
    }
}
