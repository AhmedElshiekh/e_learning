<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LessonDataResource;
use App\Http\Resources\LessonsListResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Lesson;
use Fsuuaas\LaravelPlupload\Facades\Plupload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherLessonsController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $lesson = Lesson::where('chapter_id', $id)->get();

        if ($lesson) :
            $data = LessonsListResource::collection($lesson);
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

        $request->validate([
            'chapter_id'=>'required|integer',
            'video_files.*'=>'required|max:1000',
            'material_files.*'=>'nullable',
            'topic' => 'required',
            'objective' => 'required',
            'summary' => 'required',
        ]);



        $request->video_files ? $video_files = $this->upload($request->video_files):null;
        $request->material_files ? $material_files = $this->upload($request->material_files):null;

        $lesson = new Lesson();
        //access request data
        $count =Lesson::max('id')+1;
        $lesson->slug =$request->input('topic').' '.$count ;
        $lesson->topic = $request->input('topic');
        $lesson->objective = $request->input('objective');
        $lesson->summary = $request->input('summary');
        $lesson->material = $material_files ?? null;
        $lesson->video =    $video_files ?? null;
        $lesson->course_id =$request->course_id;
        $lesson->chapter_id =$request->chapter_id;
        $lesson->save();

        if ($lesson) :
            $data = new LessonDataResource($lesson);
            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'You should login');
    }


    public function upload($request)
    {
        $file = $request;
        $filename = time().'_'.$file->getClientOriginalName();

        // File upload location
        $location = Storage::disk('uploads')->putFile('lessons', $file);

        // Upload file
        $file->move($location,$filename);

        return $location;
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Responsevideo_files
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            //'course_id'=>'required|integer',
            'chapter_id'=>'required|integer',
            'video_files.*'=>'nullable|max:1000',
            'material_files.*'=>'nullable',
            'topic' => 'required',
            'objective' => 'required',
            'summary' => 'required',
        ]);

        $lesson = Lesson::find($id);
        $lesson->topic = $request->input('topic');
        $lesson->objective = $request->input('objective');
        $lesson->summary = $request->input('summary');
        $lesson->chapter_id =$request->chapter_id;

        if ($request->video_files):
            $video_files = $this->upload($request->video_files);
            $lesson->video =$video_files;
        endif;
        if ($request->material_files):
            $material_files = $this->upload($request->material_files);
            $lesson->material =$material_files;
        endif;

        $lesson->save();

        if ($lesson) :
            $data = new LessonDataResource($lesson);
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
    public function show($id)
    {
        $lesson = Lesson::find($id);
        
        if ($lesson) :
            $data = new LessonDataResource($lesson);
            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'You should login');
    }


}
