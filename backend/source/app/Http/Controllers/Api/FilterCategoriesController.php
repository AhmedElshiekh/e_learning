<?php

namespace App\Http\Controllers\Api;


use App\CategoryCourse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryToFilterResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class FilterCategoriesController extends Controller
{
    use ApiResponseTrait;


    
    public function index()
    {
        $mainCategories = CategoryCourse::where('level','1')->get();


        if ($mainCategories) :
            return $this->apiResponse(CategoryToFilterResource::collection($mainCategories), 200);
        endif;

        return $this->apiResponse(null, 404, 'Not Found');

    }


}
