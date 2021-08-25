<?php

namespace App\Http\Controllers\Api;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Resources\CoursesResource;
use App\Http\Resources\StudentClassesResource;
use App\Http\Resources\StudentCoursesResource;
use App\Http\Resources\StudentPrivateClassesResource;
use App\Http\Resources\StudentProfileResource;
use App\Http\Resources\TeacherClassesResource;
use App\Http\Resources\TeacherCoursesResource;
use App\Http\Resources\TeacherPrivateClassesResource;
use App\Http\Resources\TeacherProfileResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use MediaUploader;


class ProfileController extends Controller
{
    use ApiResponseTrait;


    public function index()
    {
        $user = Auth::user();
        $type = $user ? $user->type : null;

        if ($type == 'student') :
            $data = new StudentProfileResource($user);
            return $this->apiResponse($data, 200, 'success');
        endif;

        if ($type == 'teacher') :
            $data = new TeacherProfileResource($user);
            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'You should login');
    }


    public function hisCourses()
    {
        $user = Auth::user();
        $type = $user ? $user->type : null;


        if ($type == 'student') :

            // dd($user->courses->where('type', 'recorded')->count()  );
            $courses = $user->courses->where('type', 'recorded');

            // dd($user->);

            if ($courses) :
                $data = StudentCoursesResource::collection($courses);
                return $this->apiResponse($data, 200, 'success');
            endif;

        endif;


        if ($type == 'teacher') :

            $courses = $user->coursesTeacher->where('type', 'recorded');

            if ($courses) :
                $data = TeacherCoursesResource::collection($courses);
                return $this->apiResponse($data, 200, 'success');
            endif;

        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'You should login');
    }


    public function hisClasses()
    {
        $user = Auth::user();
        $type = $user ? $user->type : null;

        if ($type == 'student') :

            $courses =  $user->courses->where('type', 'live');
            $data = StudentClassesResource::collection($courses);

            return $this->apiResponse($data, 200, 'success');
        endif;


        if ($type == 'teacher') :

            $courses = $user->coursesTeacher->where('type', 'live');
            $data = TeacherClassesResource::collection($courses);

            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'You should login');
    }


    public function hisPrivateClasses()
    {
        $user = Auth::user();
        $type = $user ? $user->type : null;

        if ($type == 'student') :

            $classes = Classes::where('student_id', $user->id)->get();
            $data = StudentPrivateClassesResource::collection($classes);

            return $this->apiResponse($data, 200, 'success');
        endif;


        if ($type == 'teacher') :

            $classes = Classes::where('teacher_id', $user->id)->get();
            $data = TeacherPrivateClassesResource::collection($classes);

            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'You should login');
    }


    public function updateAvatar(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'img' => 'required|image|max:50048',
        ]);

        if ($validate->fails()) : // return '422' UnProcessable Entity
            return $this->apiResponse(null, 422, $validate->errors());
        endif;

        $user = Auth::user();

        if ($request->file('img')) :
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $user->attachMedia($media, 'userAvatar');
        endif;

        $user->save();

        if ($user->type == 'student') :
            $data = new StudentProfileResource($user);
            return $this->apiResponse($data, 200, 'success');
        endif;

        if ($user->type == 'teacher') :
            $data = new TeacherProfileResource($user);
            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'You should login');
    }

}
