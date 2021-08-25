<?php

namespace App\Http\Controllers\Api;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClassesResource;
use App\Http\Resources\ClassLessonResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Classes;
use App\Models\ClassLesson;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherClassesController extends Controller
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

        $classes = Classes::where('course_id', $id)->get();

        if ($classes) :
            $data = ClassesResource::collection($classes);
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

        $class =  Classes::Create($request->all());

        $days = $request->days;
        $classDays = collect(request()->days)->filter(function ($days, $key) {
            return $days != null;
        });

        foreach ($classDays as $key => $value){
            $start = Carbon::create($request->start_from)->subDay();
            for($i= 0 ;$i < $request->weeks ;$i++){
                $date =  Carbon::parse($start->addDay($i*7))->modify("next $key")->format('Y-m-d');

               $lesson =  ClassLesson::create(['class_id'=>$class->id,'date'=>$date,'time'=>$value,'day'=>$key]);
                $start = Carbon::create($request->start_from)->subDay();
            }
        }

        if ($lesson) :
            // $data = new ChapterResource($lesson);
            return $this->apiResponse($lesson, 200, 'success');
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

        $class = Course::find($id)->classes->first();
        $lesson = $class->lessons;

        if ($lesson) :
            $data = ClassLessonResource::collection($lesson);

            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'You should login');
    }

    public function showPrivate($id)
    {

        $class = Classes::find($id);
        $lesson = $class->lessons;

        if ($lesson) :
            $data = ClassLessonResource::collection($lesson);

            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'You should login');
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
        $request->validate([
            'day'=>'required|string',
            'date'=>'required|date|after_or_equal:today',
            'time'=>'required'
        ]);
        $lesson = ClassLesson::find($id);
        $lesson->update($request->all());

        if ($lesson) :
            // $data = new ChapterResource($lesson);
            return $this->apiResponse($lesson, 200, 'success');
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
