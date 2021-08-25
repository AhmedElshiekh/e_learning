<?php

namespace App\Http\Controllers\Admin;

use App\Models\Exam;
use App\Models\ExamSection;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Section;
use Illuminate\Support\Facades\Redirect;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::all();
        return view('admin.exams.index',compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.exams.create');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function setPlacementTest(Request $request)
    {
        $exams = Exam::all();

        foreach($exams as $exam):
            $exam->global = false;
            $request->exam == $exam->id ? $exam->global = true : null;
            $exam->save();
        endforeach;

        return Redirect::back();
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
            'title'=>'required',
            'time'=>'required',
            'sections'=>'required',

        ]);
        $exam = new Exam();
        $exam->title = $request->title;
        $exam->sections_count = $request->sections;
        $exam->time = $request->time;
        $exam->save();
        // dd($request->sections>= 1);
        for($i=1; $i<=$request->sections;$i++){
            $section = new ExamSection();
            $section->name = 'Section '.$i ;
            $section->exam_id = $exam->id;
            $section->save();

        }
        return view('admin.exams.show',compact('exam'));
    }
    public function addSection(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'exam_id'=>'required',
        ]);

        $section = new ExamSection();
        $section->name = $request->name;
        $section->exam_id = $request->exam_id;
        $section->save();
// dd('ddd');
        return redirect()->back()->with('success','Section Created Succefuly');
    }
    public function updateSection(Request $request,ExamSection $section)
    {
        $request->validate([
            'name'=>'required',
            'exam_id'=>'required',
        ]);

        $section->name = $request->name;
        $section->save();
// dd('ddd');
        return redirect()->back()->with('success','Section Created Succefuly');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
        return view('admin.exams.show',compact('exam'));

    }
    public function showSection(ExamSection $section)
    {
//        dd($section->exam);
        $questions = Question::all();
        return view('admin.exams.section',compact('section','questions'));

    }
    public function getFromBank(Request $request,ExamSection $section)
    {
        $request->validate([
            'questions'=>'required',

        ]);
        foreach($request->questions as $qust):
            $question = Question::find($qust);
            if($section->questions->contains($question->id)):
            else:
            $section->questions()->attach($question);
            endif;

        endforeach;

        return Redirect::back();
    }
    public function deleteFromSection(Request $request,ExamSection $section,Question $question)
    {
        $section->questions()->detach($question);

        return Redirect::back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return Redirect::back()->with('success','exam deleted successfully');
    }
}
