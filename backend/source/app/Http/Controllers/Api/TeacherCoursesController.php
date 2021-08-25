<?php

namespace App\Http\Controllers\Api;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseAllDataResource;
use App\Http\Resources\TeachCourseLiveResource;
use App\Http\Traits\ApiResponseTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Plank\Mediable\Facades\MediaUploader;

class TeacherCoursesController extends Controller
{
    use ApiResponseTrait;


    
    public function index($teach)
    {
        $user = User::find($teach);
        $course = $user->coursesTeacher->where('type', 'live');

        if ($course) :
            $data = TeachCourseLiveResource::collection($course);
            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'You should login');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth::user();

        if(!$user || $user->type != 'teacher'):
            return $this->apiResponse(null, 400, 'You should teacher');
        endif;

        //validation
        $request->validate([
            'category'=>'required|integer',
            'subCategory'=>'required|integer',
            'category_id'=>'required|integer',
            'img.*'=>'image|mimes:jpg,png,jpeg,svg|max:3000',
            'discount'=>'nullable',
            'start_date'=>'nullable|date|before_or_equal:end_date',
            'end_date'=>'nullable|after_or_equal:start_date',
            'name' => 'required',
            'sh_desc' => 'required',
            'desc' => 'required',
            'courseType' => 'required',
            'level' => 'nullable',
        ]);

        $course = new Course();

        //access request data
        $count = Course::max('id')+1;
        $course->name           =   $request->input('name');
        $course->sh_desc        =   $request->input('sh_desc');
        $course->desc           =   $request->input('desc');
        $course->slug           =   $request->input('name').' '.$count ;
        $course->teacher_id     =   $user->id;
        $course->price          =   $request->input('price');
        $course->discountPrice  =   $request->input('discount');
        $course->start_date     =   $request->input('start_date');
        $course->end_date       =   $request->input('end_date');
        $course->course_cat_id  =   $request->input('category_id');
        $course->parent_cat_id  =   $request->input('category');
        $course->sub_cat_id     =   $request->input('subCategory');
        $course->prerequisite   =   $request->input('prerequisite');
        $course->contact        =   $request->input('contact');
        $course->level_id       =   $request->input('level');
        $course->exam_id        =   $request->input('placementTest');
        $course->type           =   $request->input('courseType');

        $course->save();

        //************************uploade photo*******************
        $file = $request->file('img');

        if ($request->hasFile('img')) {
                $media = MediaUploader::fromSource($file)->upload();
                $course->attachMedia($media, 'Course');
        }
        $course->save();

        if($course):
            $data = new CourseAllDataResource($course);
            return $this->apiResponse($data, 200, 'Success');
        endif;


        // if all failed return error 404
        return $this->apiResponse(null, 400, 'Error, Get Data');

    }


    public function update(Request $request, $id)
    {

        $user = Auth::user();

        if(!$user || $user->type != 'teacher'):
            return $this->apiResponse(null, 400, 'You should teacher');
        endif;

        //validation
        $request->validate([
            'category'=>'required|integer',
            'subCategory'=>'required|integer',
            'category_id'=>'required|integer',
            'img.*'=>'image|mimes:jpg,png,jpeg,svg|max:3000',
            'discount'=>'nullable',
            'start_date'=>'nullable|date|before_or_equal:end_date',
            'end_date'=>'nullable|after_or_equal:start_date',
            'name' => 'required',
            'sh_desc' => 'required',
            'desc' => 'required',
            'courseType' => 'required',
            'level' => 'nullable',
        ]);

        //access request data
        $course = Course::find($id);
        $course->name           =   $request->input('name');
        $course->sh_desc        =   $request->input('sh_desc');
        $course->desc           =   $request->input('desc');
        $course->teacher_id     =   $user->id;
        $course->price          =   $request->input('price');
        $course->discountPrice  =   $request->input('discount');
        $course->start_date     =   $request->input('start_date');
        $course->end_date       =   $request->input('end_date');
        $course->Course_cat_id  =   $request->input('category_id');
        $course->sub_cat_id     =   $request->input('subCategory');
        $course->prerequisite   =   $request->input('prerequisite');
        $course->contact        =   $request->input('contact');
        $course->level_id       =   $request->input('level');
        $course->type           =   $request->input('courseType');
        $course->exam_id        =   $request->input('exam');

        $course->save();

        //************************uploade photo*******************
        $file = $request->file('img');

        if ($request->hasFile('img')) {
                $media = MediaUploader::fromSource($file)->upload();
                $course->attachMedia($media, 'Course');
        }
        $course->save();

        if($course):
            $data = new CourseAllDataResource($course);
            return $this->apiResponse($data, 200, 'Success');
        endif;


        // if all failed return error 404
        return $this->apiResponse(null, 400, 'Error, Get Data');

    }


    public function show($id)
    {
        $course = Course::find($id);

        if ($course) :
            $data = new CourseAllDataResource($course);
            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'You should login');
    }


}
