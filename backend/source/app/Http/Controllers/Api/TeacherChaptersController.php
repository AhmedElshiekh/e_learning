<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChapterResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherChaptersController extends Controller
{
    use ApiResponseTrait;

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = Auth::user();

        if(!$user || $user->type != 'teacher'):
            return $this->apiResponse(null, 400, 'You should teacher');
        endif;

        $chapters = Chapter::where('course_id', $id)->get();

        if ($chapters) :
            $data = ChapterResource::collection($chapters);
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

        $request->validate([
            'course_id'=>'required|integer',
            'name'=>'required',
            'description' => 'nullable',
        ]);

        $chapter = new Chapter();

        $chapter->name = $request->input('name');
        $chapter->description = $request->input('description');
        $chapter->course_id = $request->input('course_id');

        $chapter->save();

        if ($chapter) :
            $data = new ChapterResource($chapter);
            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'You should login');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if(!$user || $user->type != 'teacher'):
            return $this->apiResponse(null, 400, 'You should teacher');
        endif;

        $request->validate([
            'course_id'=>'required|integer',
            'name'=>'required',
            'description' => 'nullable',
        ]);

        $chapter = Chapter::find($id);

        $chapter->name = $request->input('name');
        $chapter->description = $request->input('description');
        $chapter->course_id = $request->input('course_id');

        $chapter->save();

        if ($chapter) :
            $data = new ChapterResource($chapter);
            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'You should login');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
