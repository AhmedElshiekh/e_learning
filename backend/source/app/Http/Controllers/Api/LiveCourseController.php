<?php

namespace App\Http\Controllers\Api;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClassLessonListResource;
use App\Http\Resources\LiveCourseDetailsResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;

class LiveCourseController extends Controller
{
    use ApiResponseTrait;

    public function show($id)
    {

        $user = Auth::user();
        $course = Course::find($id);

        $owner = $user ? $user->courses->contains($course) : false;

        $classes = $course->classes->where('private', false)->first();
        $lessons = $classes ? ClassLessonListResource::collection($classes->lessons) :null;
        
        if ($course) :

            $data = new LiveCourseDetailsResource($course);
            $data->setAttribute('owner', $owner);
            $data->setAttribute('lessons', $lessons);

            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }
}
