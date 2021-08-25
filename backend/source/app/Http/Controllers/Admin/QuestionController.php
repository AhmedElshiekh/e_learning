<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Chapter;
use App\Models\Answer;
use App\Course;
use App\User;
use App\CategoryCourse;
use App\Level;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class QuestionController extends Controller
{

    public function index()
    {
        //
        $questions = Question::orderBy('created_at', 'desc')->paginate(20);
        // dd($questions);
        return view('admin.questions.index', compact('questions'));
    }

    // Function Show
    public function show($id)
    {
        $question = Question::find($id);
        return view('admin.courses.question.show', compact('question'));
    }



    // add question functions
    // public function create($id)
    // {
    //     $course = Course::find($id);
    //     $categoriesCourse= CategoryCourse::whereNull('parent_id')->get();
    //     $levels = Level::all();
    //     return view('admin.courses.question.create',compact('course','levels','categoriesCourse'));
    // }
    public function getFromBank(Request $request)
    {
        $request->validate([
            'course_id' => 'nullable',
            'chapter_id' => 'nullable',
            'lesson_id' => 'nullable',
        ]);

        foreach ($request->questions as $qust) :
            $question = Question::find($qust);
            $request->course_id ?  $question->course_id = $request->course_id : $question->course_id = null;
            $request->chapter_id ?  $question->chapter_id = $request->chapter_id : $question->chapter_id = null;
            $request->lesson_id ?  $question->lesson_id = $request->lesson_id : $question->lesson_id = null;
            $request->class_id ?  $question->class_id = $request->class_id : $question->class_id = null;
        endforeach;

        return Redirect::back();
    }

    // add question functions
    public function create()
    {
        $course =  null;
        $chapter =  null;
        $lesson =  null;
        $categoriesCourse = CategoryCourse::whereNull('parent_id')->get();
        $levels = Level::all();
        return view('admin.questions.create', compact('levels', 'categoriesCourse', 'course', 'chapter', 'lesson'));
    }
    public function createToCourse($id)
    {
        $course = Course::find($id) ?? null;
        $chapter =  null;
        $lesson =  null;
        $categoriesCourse = CategoryCourse::whereNull('parent_id')->get();
        $levels = Level::all();
        return view('admin.questions.create', compact('levels', 'categoriesCourse', 'course', 'chapter', 'lesson'));
    }
    public function createToChapter($id)
    {
        $chapter = chapter::find($id);
        $course = $chapter->course;
        $lesson = null;
        $categoriesCourse = CategoryCourse::whereNull('parent_id')->get();
        $levels = Level::all();
        return view('admin.questions.create', compact('levels', 'categoriesCourse', 'course', 'chapter', 'lesson'));
    }
    public function createToLesson($id)
    {
        $lesson = Lesson::find($id) ?? null;
        $chapter = $lesson->chapter;
        $course = $lesson->course;
        $categoriesCourse = CategoryCourse::whereNull('parent_id')->get();
        $levels = Level::all();
        return view('admin.questions.create', compact('levels', 'categoriesCourse', 'course', 'chapter', 'lesson'));
    }
    /////////////////
    public function store(Request $request)
    {
        //return $request;
        $request->validate([
            // 'course_id'=>'required|integer',
            'title' => 'required',
            'answers' => 'nullable',
            // 'correct_answer'=>'required',
            'category' => 'required|integer',
            'subCategory' => 'required|integer',
            'category_id' => 'required|integer',
            'level' => 'required',

        ]);

        $question = new Question();

        $question->title = $request->input('title');
        // $question->type = $request->input('type');

        $request->course_id ?  $question->course_id = $request->course_id : $question->course_id = null;
        $request->chapter_id ?  $question->chapter_id = $request->chapter_id : $question->chapter_id = null;
        $request->lesson_id ?  $question->lesson_id = $request->lesson_id : $question->lesson_id = null;
        $request->class_id ?  $question->class_id = $request->class_id : $question->class_id = null;
        $question->category_id = $request->input('category_id');
        $question->parent_cat_id = $request->input('category');
        $question->sub_cat_id = $request->input('subCategory');
        $question->score = $request->input('score');
        $question->level_id = $request->input('level');
        $question->save();



        if ($request->answers[0] != null) {
            $i = 0;
            foreach ($request->answers as  $answer) {
                $answer =  Answer::create([
                    'answer' => $answer,
                    'question_id' => $question->id
                ]);
                if ($i == 0) {
                    $question->correct_answer = $answer->id;
                    $question->save();
                }
                $i++;
            }
        }

        if ($request->lesson_id) :
            return redirect()->route('admin.lessons.show', $request->lesson_id)->with('success', 'Question Added Successfully');

        elseif ($request->chapter_id) :
            return redirect()->route('admin.chapter.show', $request->chapter_id)->with('success', 'Question Added Successfully');
        elseif ($request->course_id) :
            return redirect()->route('admin.courses.show', $request->course_id)->with('success', 'Question Added Successfully');
        endif;

        return redirect()->route('admin.question.index')->with('success', 'Question Added Successfully');
    }


    public function edit($id, Request $request)
    {
        $question = Question::find($id);
        $course = Course::find(request('course_id')) ?? null;
        $levels = Level::all();
        $categoriesCourse = CategoryCourse::whereNull('parent_id')->get();
        $correct_answer = Answer::find($question->correct_answer);
        return view('admin.questions.edit', compact('question', 'course', 'categoriesCourse', 'levels', 'correct_answer'));
    }


    public function delete($id)
    {
        $question = Question::find($id);
        $question->delete();

        return redirect()->back()->with('success', 'Question deleted successfully');
    }

    public function multiDelete(Request $request)
    {
        // dd($request);
        $request->validate([
            'questions' => 'required',
        ]);

        foreach ($request->questions as $qust) :
            $question = Question::find($qust);
            $question->delete();
        endforeach;

        return redirect()->route('admin.question.index')->with('success', 'Question deleted successfully');
    }



    public function chapter_Question(Chapter $chapter)
    {

        return  $lessons  = $chapter->lessons()->pluck('topic', 'id');
        // dd( json_encode($sub));
        // return  json_encode($sub);
    }


    public function update(Request $request)
    {

        // dd ($request);
        $request->validate([
            'question_id' => 'required',
            'title' => 'required',
            'answers' => 'nullable',
        ]);

        $question = Question::find($request->question_id);
        $question->title = $request->input('title');
        $question->save();

        if ($request->answers[0] != null) {

            $correct_ans = Answer::find($question->correct_answer);
            foreach ($question->answers as $ans) :
                $ans != $correct_ans ? $ans->delete() : null;
            endforeach;
            // $correct_ans ? $correct_ans->delete(): null;

            $i = 0;
            foreach ($request->answers as  $answer) {
                if ($i == 0) {
                    $correct_ans->answer = $answer;
                    $correct_ans->save();
                } else {
                    $answer =  Answer::create([
                        'answer' => $answer,
                        'question_id' => $question->id
                    ]);
                }
                $i++;
            }
        }

        if ($request->lesson_id) :
            return redirect()->route('admin.lessons.show', $request->lesson_id)->with('success', 'Question Added Successfully');

        elseif ($request->chapter_id) :
            return redirect()->route('admin.chapter.show', $request->chapter_id)->with('success', 'Question Added Successfully');
        elseif ($request->course_id) :
            return redirect()->route('admin.courses.show', $request->course_id)->with('success', 'Question Added Successfully');
        endif;

        return redirect()->route('admin.question.index')->with('success', 'Question Added Successfully');
    }
}
