<?php

namespace App\Http\Controllers\api;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChaptersListResource;
use App\Http\Resources\CourseDetailsResource;
use App\Http\Resources\LessonResourse;
use App\Http\Resources\LessonsListResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Chapter;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class CourseController extends Controller
{
    use ApiResponseTrait;

    public function show($id)
    {

        $user = Auth::user();
        $course = Course::find($id);

        $owner = $user ? $user->courses->contains($course) : false;

        $currentLessonKey = Lesson::where('course_id', $id)->first()->id ?? null;

        $lessons = $course->lessons;
        $lessons = LessonsListResource::collection($lessons);


        $chapters = $course->chapters;
        $chapters = ChaptersListResource::collection($chapters);

        if ($course) :

            $data = new CourseDetailsResource($course);
            $data->setAttribute('owner', $owner);
            $data->setAttribute('currentLesson', $currentLessonKey);
            $data->setAttribute('chaptersList', $chapters);

            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }



    /**
     * 1- check if test prev course is complete .
     * 2- and last exam is success .
     * 3- get lesson data .
     */
    public function lessonShow($id, $lessonClosed = false)
    {
        $user = Auth::user() ?? null;
        $currentLesson = Lesson::find($id);

        if ($currentLesson) :

            $currentChapter = $currentLesson->chapter;
            $currentCourse = $currentChapter->course;

            $prevLesson = Lesson::where('course_id', $currentCourse->id)
                ->orderBy('id', 'DESC')
                ->where('id', '<', $id)
                ->first();


            $nextLesson = Lesson::where('course_id', $currentCourse->id)
                ->where('id', '>', $id)
                ->first();

            /** this var to set all return data default current lesosn **/
            $lesson = $currentLesson;
            /** this var to check if user is owner course **/
            $isOwner = $user ? $user->courses->contains($currentCourse) : null;
            /** this var to check if prev lesson is opened or not **/
            $prevLessonOpen = $prevLesson && $user ? $user->lessons()->findOrFail($prevLesson->id, ['lesson_id'])->pivot->open : true;


            /** main check function */
            if (!$user || !$isOwner) :
                $lesson = $currentCourse->lessons->first();
                $nextLesson = null;
            elseif (!$prevLessonOpen) :
                $lessonClosed = true;
                return $this->lessonShow($prevLesson->id, $lessonClosed);
            endif;

            $nextChapter = Chapter::where('course_id', $currentChapter->course_id)
                ->where('id', '>', $currentChapter->id)
                ->first();

            $prevChapter = Chapter::where('course_id', $currentChapter->course_id)
                ->orderBy('id', 'DESC')
                ->where('id', '<', $currentChapter->id)
                ->first();

            $prevChapterFinish = $prevChapter && $user ? $user->chapters()->findOrFail($prevChapter->id, ['chapter_id'])->pivot->finish : true;


            if ($lesson) :
                // dd($prevChapterFinish);
                $data = new LessonResourse($lesson);

                $lessonStatus =  $user && $isOwner ? $user->lessons()->findOrFail($lesson->id, ['lesson_id'])->pivot->open == true ??false : false;
                // dd($lessonStatus);

                if ($lesson->questions->count() > 0) :
                    // $user ? $user->lessons()->updateExistingPivot($lesson, array('open' => true), false) : null;
                    $isQuestion = true;
                else :
                    $user ? $user->lessons()->updateExistingPivot($lesson, array('open' => true), false) : null;
                    $isQuestion = false;
                endif;


                if (!$prevChapterFinish && $prevChapter->questions->count() > 0) :
                    $prevTest = $prevChapter;
                else :
                    $user ? $user->chapters()->updateExistingPivot($prevChapter, array('finish' => true), false) : null;
                    $prevTest = null;
                endif;

                $data->setAttribute('nextLesson', $nextLesson ? $nextLesson->id : null);
                $data->setAttribute('isQuestion', $isQuestion);
                $data->setAttribute('nextChapter', $nextChapter ? $nextChapter->id : null);
                $data->setAttribute('prevTest', $prevTest ? $prevTest->id : null);
                $data->setAttribute('lessonClosed', $lessonClosed);
                $data->setAttribute('lessonStatus', $lessonStatus);


                return $this->apiResponse($data, 200, 'success');
            endif;

        endif;

        $lesson = [
            'key'           => null,
            'name'          => null,
            'video'         => null,
            'objective'     => null,
            'material'      => null,
            'summary'       => null,
            'nextLesson'    => null,
            'exam'          => null
        ];
        // if all failed return error 404
        return $this->apiResponse($lesson, 400, 'Error, Get Data');
    }
}
