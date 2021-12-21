<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Models\Chapter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Question;
use PHPUnit\Framework\Constraint\Count;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $request->validate([
            'course_id'     => 'required|integer',
            'description'   => 'nullable',
        ]);

        foreach (config('locales') as $lang):
            $request->validate([ 'name_' . $lang => 'required']);
        endforeach;

        $chapter = new Chapter();
        //access request data

        foreach (config('locales') as $lang):
            $chapter->setTranslation('name' ,$lang , $request->input('name_' . $lang ));
        endforeach;
        $chapter->description = $request->input('description');
        $chapter->course_id = $request->input('course_id');

        $chapter->save();
        //        dd($lesson);

        $course = Course::find($request->course_id);

        if ($course->students->count() > 0):
            foreach ($course->students as $user):
                $user->chapters()->attach($chapter);
            endforeach;
        endif;

        return redirect()->route('admin.courses.show', $request->course_id)->with('success', 'Chapter Added Successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chapter = Chapter::with('lessons')->whereId($id)->first();
        $questions = Question::where('parent_cat_id', $chapter->course->parent_cat_id)->orWhere('sub_cat_id', $chapter->course->sub_cat_id)->get();


        return view('admin.courses.chapters.show', compact('chapter', 'questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        // return $request;
        $request->validate([
            'course_id' => 'required|integer',
            'description' => 'nullable',
        ]);
        foreach (config('locales') as $lang):
            $request->validate([ 'name_' . $lang => 'required']);
        endforeach;


        $chapter = Chapter::find($id);
        //access request data

        foreach (config('locales') as $lang):
            $chapter->setTranslation('name' ,$lang , $request->input('name_' . $lang ));
        endforeach;
        $chapter->description = $request->input('description');
        $chapter->course_id = $request->input('course_id');

        $chapter->save();
        //        dd($lesson);

        return redirect()->route('admin.courses.show', $request->course_id)->with('success', 'Chapter Added Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chapter = Chapter::find($id);

        if($chapter->lessons->count() > 0):
            foreach ($chapter->lessons as $lesson) :
                $lesson->delete();
            endforeach;
        endif;

        $chapter->delete();

        return  back()->with('deleted', 'chapter deleted successfully');

    }
}
