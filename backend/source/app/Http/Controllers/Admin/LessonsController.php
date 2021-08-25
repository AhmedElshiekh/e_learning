<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lesson;
use App\Models\Chapter;
use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Fsuuaas\LaravelPlupload\Facades\Plupload;
use Illuminate\Support\Facades\Storage;
// use Jenky\LaravelPlupload\Facades\Plupload;

class LessonsController extends Controller
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
    public function create($id)
    {
        //        dd($id);
        $chapter = Chapter::find($id);

        return view('admin.courses.lessons.create', compact('chapter'));
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
            // 'course_id'=>'required|integer',
            'chapter_id' => 'required|integer',
            'video_files.*' => 'required|max:1000',
            'material_files.*' => 'nullable',
            // 'topic' => 'required',
            'objective' => 'required',
            'summary' => 'required',
        ]);
        foreach (config('locales') as $lang) :
            $request->validate(['topic_' . $lang => 'required']);
        endforeach;

        $lesson = new Lesson();

        //access request data
        $count = Lesson::max('id') + 1;
        // $lesson->slug =$request->input('topic_en').' '.$count ;
        foreach (config('locales') as $lang) :
            $lesson->setTranslation('topic', $lang, $request->input('topic_' . $lang));
        endforeach;
        $lesson->objective = $request->input('objective');
        $lesson->summary = $request->input('summary');
        $lesson->material = $request->material_files[0] ?? null;
        $lesson->video =    $request->video_files[0];
        $lesson->course_id = $request->course_id;
        $lesson->chapter_id = $request->chapter_id;
        $lesson->save();
        //        dd($lesson);

        return redirect()->route('admin.chapter.show', $request->chapter_id)->with('success', 'Lesson Added Successfully');
    }


    public function upload(Request $request)
    {
        return  Plupload::file('file', function ($file) {
            $path = Storage::disk('uploads')->putFile('lessons', $file);
            return [
                'success' => true,
                'message' => 'Upload successful.',
                'id' => $path,
            ];
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);
        return view('admin.courses.lessons.show', compact('lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = Lesson::find($id);
        $course = Course::find($lesson->course_id);
        $chapters = Chapter::where('course_id', $course->id)->get();
        return view('admin.courses.lessons.edit', compact('lesson', 'course', 'chapters'));
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
            //'course_id'=>'required|integer',
            'chapter_id' => 'required|integer',
            'video_files.*' => 'nullable|max:1000',
            'material_files.*' => 'nullable',
            // 'topic' => 'required',
            'objective' => 'required',
            'summary' => 'required',
        ]);
        foreach (config('locales') as $lang) :
            $request->validate(['topic_' . $lang => 'required']);
        endforeach;

        $lesson = Lesson::find($id);

        //access request data
        foreach (config('locales') as $lang) :
            $lesson->setTranslation('topic', $lang, $request->input('topic_' . $lang));
        endforeach;
        $lesson->objective = $request->input('objective');
        $lesson->summary = $request->input('summary');
        $lesson->chapter_id = $request->chapter_id;
        $lesson->material = $request->material_files[0] ?? $lesson->material;

        if ($request->video_files) {
            $lesson->video = $request->video_files[0];
        }
        $lesson->save();

        return redirect()->route('admin.chapter.show', $lesson->chapter_id)->with('success', 'Lesson Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::find($id);
        $lesson->delete();

        return redirect()->back()->with('success', 'Lesson deleted successfully');
    }
}
