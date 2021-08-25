<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionsResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Chapter;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionsController extends Controller
{

    use ApiResponseTrait;


    public function quizLesson($id)
    {
        $lesson = Lesson::find($id);

        $question = $lesson? $lesson->questions: null;

        if ($question) :

            $data = QuestionsResource::collection($question);
            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }



    public function quizChapter($id)
    {
        $chapter = Chapter::find($id);

        $question = $chapter ? $chapter->questions: null;

        if ($question) :

            $data = QuestionsResource::collection($question);
            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }




    public function resultQuiz(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'result'        => 'nullable|boolean',
            'lesson_key'    => 'nullable|integer',
            'chapter_key'   => 'nullable|integer',
        ]);

        if ($validate->fails()) : // return '422' UnProcessable Entity
            return $this->apiResponse(null, 422, $validate->errors());
        else :

            $user = Auth::user();
            $res = $request->result;
            $nextLesson =null;

            if($lid = $request->lesson_key):
                $lesson = Lesson::find($lid);
                $course = $lesson->course;
                $nextLesson = Lesson::where('course_id', $course->id)
                    ->where('id', '>', $lid)
                    ->first();
                $res == true ? $user->lessons()->updateExistingPivot($lesson, array('open' => true), false) : null;
            endif;

            if($cid = $request->chapter_key):
                $chapter = Chapter::find($cid);
                $lesson = $chapter->lessons()->latest()->first();
                $course = $chapter->course;
                $nextChapter = Chapter::where('course_id', $course->id)
                    ->where('id', '>', $chapter->id)
                    ->first();
                $nextLesson = $nextChapter->lessons->first();
                $res == true ? $user->chapters()->updateExistingPivot($chapter, array('finish' => true), false) : null;
            endif;



            if ($lesson) : // return '200' Successfully
                $data =[
                    'nextLesson'    => $nextLesson ? $nextLesson->id: $lesson->id,
                    'course'        => $course->id,
                    'pass'          => $res,
                ];
                return $this->apiResponse($data, 200);
            endif;
        endif;

        // if all failed return error 520
        return $this->apiResponse(null, 520, 'Un Know Error');
    }


}
