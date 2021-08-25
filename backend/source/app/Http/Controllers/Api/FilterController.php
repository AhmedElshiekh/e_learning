<?php

namespace App\Http\Controllers\Api;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Resources\FilterResultResource;
use App\Http\Resources\TeacherResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilterController extends Controller
{
    use ApiResponseTrait;


    /**
     *  Display a listing of the times available and notAvailable.
     *  to doctor and take doctor-id has login .
     */

    public function filter(Request $request)
    {

        $course = Course::where('course_cat_id', $request->endCategory)->get();


        if (count($course) > 0) :
            return $this->apiResponse(FilterResultResource::collection($course), 200);
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'Not Found');
    }



    public function search(Request $request)
    {
        // $course = Course::where('name', 'LIKE', "%{$request->search}%")->get();
        $allCourse = Course::all();
        $data = [];

        foreach ($allCourse as $course) :
            if(str_contains($course->name, $request->search)):
                $dataCourse = [
                    'key'                   => $course->id,
                    'name'                  => $course->name,
                    'slug'                  => $course->slug,
                    'type'                  => $course->type,
                    'image'                 => $course->hasMedia('Course') ? $course->firstMedia('Course')->getUrl() : null,
                    'short_description'     => $course->sh_desc,
                    'level'                 => $course->level->name,
                    'price'                 => $course->price,
                    'discountPrice'         => $course->discountPrice,
                    'category'              => $course->parentCategory->name . '/' . $course->categoryCourse->name,
                    'start_time'            => $course->classes->where('private', false)->first()->start_from ?? null,
                    'teachers'              => TeacherResource::collection($course->teachers),
                ];
                array_push($data, $dataCourse);
            endif;
        endforeach;

        
        if ($data > 0) :
            return $this->apiResponse($data, 200);
        endif;

        return $this->apiResponse(null, 404, 'Not Found');
    }


}
