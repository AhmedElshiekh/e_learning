<?php

namespace App\Http\Controllers\Api;

use App\CategoryCourse;
use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCourseResource;
use App\Http\Resources\LevelsResource;
use App\Http\Traits\ApiResponseTrait;
use App\Level;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    public function mainCategory(){

        $categoriesCourse = CategoryCourse::whereNull('parent_id')->get();
        if(count($categoriesCourse)> 0):
            $data = CategoryCourseResource::collection($categoriesCourse);
            return $this->apiResponse($data, 200, 'You should teacher');
        endif;

        return $this->apiResponse(null, 400, 'Not Found any data');
    }


    public function subCategory($id){

        $subCategory = CategoryCourse::where('parent_id',$id)->where('level', '2')->get();

        if(count($subCategory) > 0):
            $data = CategoryCourseResource::collection($subCategory);
            return $this->apiResponse($data, 200, 'You should teacher');
        endif;

        return $this->apiResponse(null, 400, 'Not Found any data');
    }

    public function endCategory($id){

        $subCategory = CategoryCourse::where('parent_id',$id)->where('level', '3')->get();

        if(count($subCategory) > 0):
            $data = CategoryCourseResource::collection($subCategory);
            return $this->apiResponse($data, 200, 'You should teacher');
        endif;

        return $this->apiResponse(null, 400, 'Not Found any data');
    }


    public function levels(){

        $levels = Level::all();

        if(count($levels)> 0):
            $data = LevelsResource::collection($levels);
            return $this->apiResponse($data, 200, 'You should teacher');
        endif;

        return $this->apiResponse(null, 400, 'Not Found any data');
    }

}
