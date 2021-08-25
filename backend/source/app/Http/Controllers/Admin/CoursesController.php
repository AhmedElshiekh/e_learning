<?php

namespace App\Http\Controllers\Admin;

use App\CategoryCourse;
use App\Country;
use App\Http\Controllers\Controller;
use App\Models\CourseAttribute;
use App\Models\CourseVariation;
use App\Course;
use App\Level;
use App\Models\Exam;
use App\Models\Question;
use App\Provider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use MediaUploader;
use Plank\Mediable\Media;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::where('type', 'recorded')->latest()->paginate(15);
        return view('admin.courses.index', compact('courses'));
    }
    public function liveCourses()
    {

        $courses = Course::where('type', 'live')->latest()->paginate(15);
        // dd($courses);
        return view('admin.courses.live.index', compact('courses'));
    }


    public function status(Request $request, Course $course)
    {
        $course->status = $request->status;
        $course->save();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoriesCourse = CategoryCourse::whereNull('parent_id')->get();
        //        $attributes = Attribute::all();
        $teachers = User::where(['type' => 'teacher', 'approved' => 1])->get();
        $levels = Level::all();
        $exams = Exam::all();

        return view('admin.courses.create', compact('categoriesCourse', 'teachers', 'levels', 'exams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $request->validate([
            'category' => 'required|integer',
            'subCategory' => 'required|integer',
            'category_id' => 'required|integer',
            'img.*' => 'image|mimes:jpg,png,jpeg,svg|max:3000',
            'discount' => 'nullable',
            'start_date' => 'nullable|date|before_or_equal:end_date',
            'end_date' => 'nullable|after_or_equal:start_date',
            // 'name' => 'required',
            // 'sh_desc' => 'required',
            'desc' => 'required',
            'courseType' => 'required',
            'level' => 'nullable',
        ]);
        foreach (config('locales') as $locale) {
            $request->validate([
                'name_' . $locale => 'required',
                'sh_desc_' . $locale => 'required',
                //    'desc_'.$locale => 'required',
            ]);
        }
        $course = new Course();
        foreach (config('locales') as $locale) {
            $course->setTranslation('name', $locale,  $request->input('name_' . $locale));
            $course->setTranslation('sh_desc', $locale,  $request->input('sh_desc_' . $locale));
            // $course->setTranslation('desc', $locale,  $request->input('desc_'.$locale));
        }
        //access request data
        $count = Course::max('id') + 1;
        // $course->name =$request->input('name');
        // $course->sh_desc =$request->input('sh_desc');
        $course->desc = $request->input('desc');
        $course->slug = $request->input('name_en') . ' ' . $count;
        $course->price = $request->input('price');
        $course->discountPrice = $request->input('discount');
        $course->start_date = $request->input('start_date');
        $course->end_date = $request->input('end_date');
        $course->course_cat_id = $request->input('category_id');
        $course->parent_cat_id = $request->input('category');
        $course->sub_cat_id = $request->input('subCategory');
        $course->prerequisite = $request->input('prerequisite');
        $course->contact = $request->input('contact');
        $course->level_id = $request->input('level');
        $course->placementTest_id = $request->input('placementTest');
        $course->exam_id = $request->input('exam');
        $course->type = $request->input('courseType');
        $course->free = $request->input('free') ?? false;
        // $course->teacher_id = $request->input('teacher_id');
        // $course->teachers = $request->input('teachers');

        $course->save();

        foreach ($request->teachers as $teacher) :
            $course->teachers()->attach($teacher);
        endforeach;

        //************************uploade photo*******************
        $file = $request->file('img');

        if ($request->hasFile('img')) {
            $media = MediaUploader::fromSource($file)->upload();
            $course->attachMedia($media, 'Course');
        }
        $course->save();
        if ($course->type == 'live') {
            return redirect()->route('admin.liveCourses.index')->with('success', "Course $course->name added successfully");
        } else {
            return redirect()->route('admin.courses.index')->with('success', "Course $course->name added successfully");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        $chapters = $course->chapters;
        $questions = Question::where('parent_cat_id', $course->parent_cat_id)->where('course_id', '!==', $course->id)->latest()->get();
        return view('admin.courses.show', compact('course', 'chapters', 'questions'));
    }

    public function showLiveCourses($id)
    {
        $course = Course::find($id);
        $classes = $course->classes->where('private' , false);
        $questions = Question::where('parent_cat_id', $course->parent_cat_id)->orWhere('sub_cat_id', $course->sub_cat_id)->latest()->get();

        return view('admin.courses.live.show', compact('course', 'classes', 'questions'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        $categoriesCourse = CategoryCourse::where('parent_id', null)->get();
        $teachers = User::where(['type' => 'teacher', 'approved' => 1])->get();
        $levels = Level::all();
        $exams = Exam::all();
        return view('admin.courses.edit', compact('course', 'categoriesCourse', 'teachers', 'levels', 'exams'));
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
        //validation
        $request->validate([
            'category' => 'required|integer',
            'img.*' => 'image|mimes:jpg,png,jpeg,svg|max:3000',
        ]);

        foreach(config('locales') as $locale){
            $request->validate([
                'name_'.$locale => 'required',
                'sh_desc_'.$locale => 'required',
                // 'desc_'.$locale => 'required',
            ]);
        }

        $course = Course::find($id);

        foreach(config('locales') as $locale){
            $course->setTranslation('name', $locale,  $request->input('name_'.$locale));
            $course->setTranslation('sh_desc', $locale,  $request->input('sh_desc_'.$locale));
            // $course->setTranslation('desc', $locale,  $request->input('desc_'.$locale));
        }
        //access request data
        // $course->name = $request->input('name');
        // $course->sh_desc = $request->input('sh_desc');
        $course->desc = $request->input('desc');
        // $course->teacher_id = $request->input('teacher_id');
        $course->price = $request->input('price');
        $course->discountPrice = $request->input('discount');
        $course->start_date = $request->input('start_date');
        $course->end_date = $request->input('end_date');
        $course->Course_cat_id = $request->input('category_id');
        $course->sub_cat_id = $request->input('subCategory');
        $course->prerequisite = $request->input('prerequisite');
        $course->contact = $request->input('contact');
        $course->level_id = $request->input('level');
        $course->type = $request->input('courseType');
        $course->placementTest_id = $request->input('placementTest');
        $course->exam_id = $request->input('exam');
        $course->free = $request->input('free') ?? false;


        $course->save();


        $course->teachers()->detach();
        foreach ($request->teachers as $teacher) :
            $course->teachers()->attach($teacher);
        endforeach;

        //************************uploade photo*******************
        $file = $request->file('img');
        if ($request->hasFile('img')) {
            //    foreach ($files as $file){

            $media = MediaUploader::fromSource($file)->upload();
            $course->attachMedia($media, 'Course');

            //    }
        }
        return redirect()->route('admin.courses.index')->with('success', "Course $course->name updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return 'sassa';
        $course = Course::find($id);
        $course->delete();

        return redirect()->back()->with('success', 'Course deleted successfully');
    }


    public function deleteImage(Media $media)
    {
        $media->delete();
        return redirect()->back()->with('success', "image removed successfully");
    }
}
