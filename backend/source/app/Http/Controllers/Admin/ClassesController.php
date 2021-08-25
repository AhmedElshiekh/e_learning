<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Models\Classes;
use App\Models\ClassLesson;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Requests;
use Illuminate\Support\Carbon;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function index()
    {

        $classes=Classes::orderBy('created_at','desc')->where('private',true)->paginate(20);
        return view('admin.classes.index', compact('classes'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = User::where(['type'=>'student','approved'=>1])->get();
        $teachers = User::where(['type'=>'teacher','approved'=>1])->get();
        $courses = Course::where('type' , 'live')->get();

        return view('admin.classes.create',compact('students','teachers', 'courses'));
    }

    public function createFromRequests($request)
    {
        $request = Requests::find($request);
        // $students = User::where(['type'=>'student','approved'=>1])->get();
        $teachers = User::where(['type'=>'teacher'])->get();
        $courses = Course::where('type' , 'live')->get();

        return view('admin.classes.createFromRequests',compact('request', 'teachers', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;

       $class =  Classes::Create($request->all());

        $days = $request->days; //define qty
        $classDays = collect(request()->days)->filter(function ($days, $key) {
            return $days != null;
        });
       // dd($classDays);

        foreach ($classDays as $key => $value){
            $start = Carbon::create($request->start_from)->subDay();
        //    $i= 0;
            for($i= 0 ;$i < $request->weeks ;$i++){
                $date =  Carbon::parse($start->addDay($i*7))->modify("next $key")->format('Y-m-d');

               $lesson =  ClassLesson::create(['class_id'=>$class->id,'date'=>$date,'time'=>$value,'day'=>$key]);
                $start = Carbon::create($request->start_from)->subDay();
            }
        }
        if($request->student_id){

        $student  = User::find($request->student_id);
            $student->classes =- $classDays->count()*$request->weeks;
            $student->save();
        }

        //notfication here
        return redirect()->route('admin.classes.show',$class->id)->with('success','Class Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $class = Classes::find($id);
        return view('admin.classes.show',compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function updateLesson(Request $request, ClassLesson $lesson)
    {
        $request->validate([
            'day'=>'required|string',
            'date'=>'required|date|after_or_equal:today',
            'time'=>'required'
        ]);
        $lesson->update($request->all());
        return redirect()->back()->with('success','Done');
    }
    public function changeStatus(ClassLesson $lesson,$status)
    {
        $lesson->status = $status;
        $lesson->save();
        // $student  = User::find($lesson->course->student_id);
        // if ($status == 'canceled' && !$lesson->course->free){
        //     $student->classes =- 1;
        //     $student->save();
        // }
        return redirect()->back()->with('success','Done');
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
