<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSectionExam extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function studentExam()
    {
        return $this->belongsTo(StudentExams::class);
    }

    public function section()
    {
        return $this->belongsTo(ExamSection::class, 'exam_section_id');
    }
}
