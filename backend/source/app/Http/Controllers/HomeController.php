<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseLesson;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->type == 'student') {
            $lessons = CourseLesson::where('status', 'in progress')->where('date', '>=', today())->whereHas('course', function ($q) {
                $q->where('student_id', auth()->user()->id);
            })->orderBy('date')->get();
        } else {
            $lessons = CourseLesson::where('status', 'in progress')->where('date', '>=', today())->whereHas('course', function ($q) {
                $q->where('teacher_id', auth()->user()->id);
            })->orderBy('date')->get();
        }
        //        dd($courses);
        return view('home', compact('lessons', 'user'));
    }
    public function myAccount()
    {
        $user = Auth::user();
        return view('frontend.user.myAccount', compact('user'));
    }
    public function myClasses()
    {
        $user = Auth::user();
        if ($user->type == 'student') {
            $courses = Course::where('student_id', $user->id)->get();
        } else {
            $courses = Course::where('teacher_id', $user->id)->get();
        }
        return view('frontend.user.myClasses', compact('user', 'courses'));
    }
    public function showClass(Course $course)
    {
        $user = Auth::user();
        if ($course->student_id !== $user->id && $course->teacher_id !== $user->id) {
            return redirect()->back();
        }
        return view('frontend.user.showClass', compact('user', 'course'));
    }
    public function completeClass(CourseLesson $lesson, Request $request)
    {
        $user = Auth::user();
        if ($lesson->course->teacher_id !== $user->id) {
            return redirect()->back();
        }
        $lesson->status = "completed";
        $lesson->comment = $request->comment;
        $lesson->save();
        //        $lesson->course->teacher->remaining += $lesson->course->session_time *( $lesson->course->teacher->hourly_price/60);
        //        $lesson->course->teacher->save();
        return redirect()->back()->with('success', 'Lesson Completed Successfully');
    }
    public function approveClass(Course $course, $status)
    {
        $user = Auth::user();
        if ($course->teacher_id !== $user->id) {
            return redirect()->back();
        }
        $course->teacher_approve = $status;
        if ($status == 0) {
            $course->student->classes += $course->lessons->where('status', '!=', 'canceled')->count();
            $course->student->save();
        }
        $course->save();
        return redirect()->back()->with('success', 'Done');
    }
    public function update(Request $request)
    {

        //validation
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable|max:25|min:6|confirmed',
            'phone' => 'nullable',
            'zoom' => 'url|nullable',
            'video' => 'url|nullable',
            'qualifications' => 'nullable',
            'oldPassword' => 'string|nullable',
            'newPassword' => 'nullable|string|confirmed'

        ]);
        $user = \auth()->user();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->zoom = $request->get('zoom');
        $user->video = $request->get('video');
        $user->qualifications = $request->get('qualifications');
        $user->country = $request->get('country');
        $user->teachCourses()->sync($request->courses);
        if ($request->oldPassword) {
            if (Hash::check($request->oldPassword, $user->password)) {
                $user->password = Hash::make($request->newPassword);
            } else {
                return redirect()->back()->with('error', 'invalid old Password ');
            }
        }
        $user->save();

        return redirect()->back()->with('success', "Profile Updated successfully");
    }
}
