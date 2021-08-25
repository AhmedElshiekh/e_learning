<?php

namespace App;

use App\Models\Chapter;
use App\Models\Classes;
use App\Models\ClassLesson;
use App\Models\Exam;
use App\Models\Lesson;
use App\Models\StudentExams;
use App\Models\TeacherAppointment;
use App\Models\UserVerified;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Plank\Mediable\Mediable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;
    use Mediable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type','phone','country','facebook','whatsApp','qualifications','age','academic_year','timezone','approved', 'verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getVideoAttribute($value)
    {
        $video = str_replace('watch?v=', 'embed/', $value);
        return $video;

    }
    // public function teachCourses()
    // {
    //     return $this->belongsToMany(Product::class, 'teacher_courses','user_id','product_id');
    // }

    public function teacherAppointment()
    {
        return $this->hasOne(TeacherAppointment::class,'user_id');
    }


    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }


    public function chapters()
    {
        return $this->belongsToMany(Chapter::class, 'lesson_chapter_student', 'user_id')->withPivot('finish');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_chapter_student', 'user_id')->withPivot('open') ;
    }

    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'lesson_chapter_student', 'user_id')->withPivot('finish') ;
    }

    public function classLessons()
    {
        return $this->belongsToMany(ClassLesson::class, 'lesson_chapter_student', 'user_id')->withPivot('open') ;
    }


    public function exams(){
        return $this->hasMany(StudentExams::class);
    }


    public function verify_msg()
    {
        return $this->hasOne(UserVerified::class,'user_id');
    }

    public function requests()
    {
        return $this->hasMany(Requests::class,'user_id');
    }

    public function coursesTeacher()
    {
        return $this->belongsToMany(Course::class, 'teacher_courses',  'user_id', 'course_id');
    }

}
