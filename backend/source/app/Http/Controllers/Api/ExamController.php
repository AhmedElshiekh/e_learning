<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use App\Http\Resources\ResultExamResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Exam;
use App\Models\Question;
use App\Models\StudentExams;
use App\Models\StudentSectionExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    use ApiResponseTrait;


    public function globalPlacementTest()
    {
        $user = Auth::user();
        $exam = Exam::where('global', true)->first();

        if ($user && $exam) :
            $data = [
                'exam_key' => $exam->id
            ];
            return $this->apiResponse($data, 200, 'success');
        endif;
        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }



    public function show($id)
    {
        $user = Auth::user();
        $exam = Exam::find($id);

        if ($user && $exam) :
            $data = new ExamResource($exam);
            return $this->apiResponse($data, 200, 'success');
        endif;
        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }


    /**
     * you should send result exam in list of json
     * sample example => result json
     *
       [
           {
               "section" : "12",
               "questions":[
                   {"question" : "15",  "answer"   : "24"},
                   {"question" : "20",  "answer"   : "12"}
               ]
           },
           {
               "section" : "13",
               "questions":[
                   {"question" : "15",  "answer"   : "22"},
                   {"question" : "20",  "answer"   : "35"}
               ]
           }
       ]
     *
     */

    public function complete(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'exam_key'      => 'required|integer',
            'result'        => 'required|json',
        ]);

        if ($validate->fails()) : // return '422' UnProcessable Entity
            return $this->apiResponse(null, 422, $validate->errors());
        endif;

        $user   = Auth::user();
        $exam   = Exam::find($request->exam_key);
        $result = json_decode($request->result);

        // function get score sections and all exam
        $score = $this->getExamScore($user, $exam, $result);

        if ($score) :
            $data = new ResultExamResource($score);
            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }


    public function getScore($result)
    {

        $total = 0;
        $score = 0;

        foreach ($result as $res) :
            $que = Question::find($res->question);
            $ans = $res->answer;
            $cAns = $que->correct_answer ?? null;
            $total += $que->score;
            $pass = $cAns == $ans ? true : false;
            $score = $pass ? $que->score + $score : $score;
        endforeach;

        $data = [
            'score' => $score,
            'total' => $total
        ];

        return json_encode($data);
    }


    public function getExamScore($user, $exam, $result)
    {

        $thisExam = StudentExams::where("exam_id", $exam->id)
            ->where('user_id', $user->id)->first();

        if ($thisExam) :
            $studentExam = $thisExam;
        else :
            $studentExam = new StudentExams;
            $studentExam->exam_id = $exam->id;
            $studentExam->user_id = $user->id;
            $studentExam->save();
        endif;

        $score = 0;
        $total = 0;

        foreach ($result as $res) :
            $queScore = json_decode($this->getScore($res->questions));

            $sec =  $thisExam ? $thisExam->sections->where('exam_section_id', $res->section)->first() : null;
            $sec ?? $sec = new StudentSectionExam;

            $sec->exam_section_id   = $res->section;
            $sec->student_exams_id  = $studentExam->id;
            $sec->score             = $queScore->score;
            $sec->total             = $queScore->total;
            $sec->save();

            $score += $queScore->score;
            $total += $queScore->total;
        endforeach;

        $rate = ($score / $total) * 100;
        $pass = $rate > 50 ? true : false;

        $studentExam->score = $score;
        $studentExam->total = $total;
        $studentExam->rate  = $rate;
        $studentExam->pass  = $pass;
        $studentExam->save();

        return ($studentExam);
    }
}
