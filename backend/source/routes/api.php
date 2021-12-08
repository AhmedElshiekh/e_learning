<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\FilterCategoriesController;
use App\Http\Controllers\Api\FilterController;
use App\Http\Controllers\Api\LiveCourseController;
use App\Http\Controllers\Api\OrderCoursesController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\QuestionsController;
use App\Http\Controllers\Api\RequestController;
use App\Http\Controllers\Api\StudentProfileController;
use App\Http\Controllers\Api\TeacherChaptersController;
use App\Http\Controllers\Api\TeacherClassesController;
use App\Http\Controllers\Api\TeacherCoursesController;
use App\Http\Controllers\Api\TeacherLessonsController;
use App\Http\Controllers\Api\TeacherPageController;
use App\Http\Controllers\Api\TeacherProfileController;
use App\Http\Controllers\Api\InstructorsController;
use App\Http\Controllers\Api\ZoomMeetingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['api', 'lang']], function ($router) {
    Route::post('login',    [AuthController::class, 'login']);
    Route::post('logout',   [AuthController::class, 'logout']);
    Route::post('register',  [AuthController::class, 'register']);
    Route::post('check',  [AuthController::class, 'authCheck']);
    Route::post('refresh',  [AuthController::class, 'refresh']);
    Route::post('resendVerifyCode/{uid}',  [AuthController::class, 'resendVerifyCode']);
    Route::post('verification/{uid}',  [AuthController::class, 'verification']);

    Route::get('/slider', 'HomeController@slider');
    Route::get('/categories', 'HomeController@categories');
    Route::get('/features', 'HomeController@features');
    Route::get('/courses', 'HomeController@courses');
    Route::get('/analysis', 'HomeController@analysis');
    Route::get('/liveCourses', 'HomeController@liveCourses');
    Route::get('/teachers', 'HomeController@teachers');
    Route::get('/about', 'HomeController@aboutUs');
    Route::get('/footer', 'HomeController@footer');
    Route::get('/global', 'HomeController@global');

    Route::get('/instructors', [InstructorsController::class, 'index']);
    Route::get('/instructor/{id}', [InstructorsController::class, 'show']);

    Route::get('/contactUs', [ContactUsController::class, 'contactUs']);
    Route::post('/sendMessage', [ContactUsController::class, 'message']);


    Route::get('/payment/{id}', [OrderCoursesController::class, 'payment']);
    Route::get('/success', [OrderCoursesController::class, 'success'])->name('api.payment.success');
    Route::get('/cancel', [OrderCoursesController::class, 'cancel'])->name('api.payment.cancel');


    Route::get('/courseDetails/{id}', [CourseController::class, 'show']);
    Route::get('/lessonShow/{id}', [CourseController::class, 'lessonShow']);

    Route::get('/liveCourseDetails/{id}', [LiveCourseController::class, 'show']);

    Route::get('/categoriesFilter', [FilterCategoriesController::class, 'index']);
    // Route::get('/categoriesFilter', [FilterCategoriesController::class, 'index']);
    Route::post('/search', [FilterController::class, 'search']);
    Route::post('/filter', [FilterController::class, 'filter']);


    Route::group(['middleware' => ['auth:api']], function () {
        /** Student Profile **/
        Route::get('/myAccount', [ProfileController::class, 'index']);
        Route::get('/myCourses', [ProfileController::class, 'hisCourses']);
        Route::get('/myClasses', [ProfileController::class, 'hisClasses']);
        Route::get('/myPrivateClasses', [ProfileController::class, 'hisPrivateClasses']);

        Route::post('/studentEditProfile', [StudentProfileController::class, 'update']);
        Route::post('/teacherEditProfile', [TeacherProfileController::class, 'update']);
        Route::post('/userEditAvatar', [ProfileController::class, 'updateAvatar']);

        Route::get('/mainCategory', [CategoryController::class, 'mainCategory']);
        Route::get('/subCategory/{id}', [CategoryController::class, 'subCategory']);
        Route::get('/levels', [CategoryController::class, 'levels']);

        Route::get('/classLesson/{class_id}', [TeacherClassesController::class, 'show']);
        Route::get('/privateClassLesson/{class_id}', [TeacherClassesController::class, 'showPrivate']);

        Route::post('/createCourse', [TeacherCoursesController::class, 'store']);
        Route::get('/dataCourse/{course_id}', [TeacherCoursesController::class, 'show']);
        Route::post('/updateCourse/{course_id}', [TeacherCoursesController::class, 'update']);

        Route::get('/allChapter/{course_id}', [TeacherChaptersController::class, 'index']);
        Route::post('/createChapter', [TeacherChaptersController::class, 'store']);
        Route::post('/editChapter/{chapter_id}', [TeacherChaptersController::class, 'update']);

        Route::get('/allLesson/{chapter_id}', [TeacherLessonsController::class, 'index']);
        Route::get('/dataLesson/{lesson_id}', [TeacherLessonsController::class, 'show']);
        Route::post('/createLesson', [TeacherLessonsController::class, 'store']);
        Route::post('/editLesson/{lesson_id}', [TeacherLessonsController::class, 'update']);

        // Route::post('/updateStudentProfile', [ProfileController::class, 'index']);

        Route::post('/startMeeting', [ZoomMeetingController::class, 'store']);
        Route::get('/showMeeting/{id}', [ZoomMeetingController::class, 'show']);
        Route::get('/zoomCredential', [ZoomMeetingController::class, 'zoomCredential']);
        Route::get('/flutterZoomCredential', [ZoomMeetingController::class, 'flutterZoomCredential']);
        Route::get('/finishMeeting/{id}', [ZoomMeetingController::class, 'destroy']);


        Route::get('/quizLesson/{id}', [QuestionsController::class, 'quizLesson']);
        Route::get('/quizChapter/{id}', [QuestionsController::class, 'quizChapter']);
        Route::post('/resultQuiz', [QuestionsController::class, 'resultQuiz']);

        Route::get('/goToExam/{id}', [ExamController::class, 'show']);
        Route::get('/placementTest', [ExamController::class, 'globalPlacementTest']);
        Route::post('/finishExam', [ExamController::class, 'complete']);

        Route::post('/classRequest', [RequestController::class, 'store']);
        Route::get('/courseFromTeacher/{tech}', [TeacherCoursesController::class, 'index']);
    });
});
