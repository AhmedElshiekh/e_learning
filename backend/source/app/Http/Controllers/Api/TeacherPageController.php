<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeacherResource;
use App\Http\Traits\ApiResponseTrait;
use App\User;
use Illuminate\Http\Request;

class TeacherPageController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $teachers = User::where('type', 'teacher')->get() ;

        if($teachers):
            return $this->apiResponse( TeacherResource::collection($teachers), 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }


    public function show($id)
    {
        $teachers = User::where('type', 'teacher')->get() ;

        if($teachers):
            return $this->apiResponse( TeacherResource::collection($teachers), 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }



}
