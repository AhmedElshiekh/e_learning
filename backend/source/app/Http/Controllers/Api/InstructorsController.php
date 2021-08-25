<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InstructorDetailsResource;
use App\Http\Resources\TeacherResource;
use App\Http\Traits\ApiResponseTrait;
use App\User;
use Illuminate\Http\Request;

class InstructorsController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageLimit = $this->page();

        $instructors = User::where('type', 'teacher')->latest()->paginate($pageLimit);

        if ($instructors) :

            $currentPage = $instructors->currentPage();
            $lastPage    = $instructors->lastPage();

            return $this->apiResponse(TeacherResource::collection($instructors), 200, 'success', $currentPage, $lastPage);
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');

    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instructor = User::find($id);

        if ($instructor) :
            $data = new InstructorDetailsResource($instructor);
            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }


}
