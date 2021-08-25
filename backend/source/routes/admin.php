<?php

use App\Admin;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    //dd($users);

    return view('admin.home');
})->name('home');

Route::prefix('roles')->group(function () {

    Route::group(['middleware' => ['permission:read role']], function () {
        Route::get('all', 'Admin\RolesController@index')->name('role.all');
    });
    Route::group(['middleware' => ['permission:create role']], function () {
        Route::get('create', 'Admin\RolesController@create')->name('role.create');
        Route::post('create', 'Admin\RolesController@store')->name('role.store');
    });
    Route::group(['middleware' => ['permission:update role']], function () {
        Route::get('edit/{role}', 'Admin\RolesController@edit')->name('role.edit');
        Route::post('edit/{role}', 'Admin\RolesController@update')->name('role.update');
    });
    Route::group(['middleware' => ['permission:delete role']], function () {
        Route::get('delete/{role}', 'Admin\RolesController@destroy')->name('role.destroy');
    });
});


Route::group(['prefix' => 'users'], function () {

    Route::group(['middleware' => ['permission:read user']], function () {
        Route::get('all', 'Admin\UsersController@index')->name('users.all');
    });
    Route::group(['middleware' => ['permission:create user']], function () {
        Route::get('create', 'Admin\UsersController@create')->name('users.create');
        Route::post('create', 'Admin\UsersController@store')->name('users.store');
    });
    Route::group(['middleware' => ['permission:update user']], function () {
        Route::get('edit/{user}', 'Admin\UsersController@edit')->name('users.edit');
        Route::post('edit/{user}', 'Admin\UsersController@update')->name('users.update');
    });
    Route::group(['middleware' => ['permission:delete user']], function () {
        Route::get('delete/{user}', 'Admin\UsersController@destroy')->name('users.destroy');
    });
});


Route::group(['middleware' => ['permission:control testmonial section']], function () {

    Route::resource('testmonials', 'Admin\TestmonialController');
    Route::get('/testmonial/{id}', 'Admin\TestmonialController@destroy')->name('testmonial.destroy');
    Route::get('/testmonialSetting', 'Admin\TestmonialController@setting')->name('setting');
});


Route::group(['middleware' => ['permission:control grade section']], function () {

    Route::resource('grade', 'Admin\GradeController');
    Route::get('/grade/{grade}', 'Admin\GradeController@destroy')->name('grade.destroy');
});


Route::group(['middleware' => ['permission:sort sections']], function () {
    Route::get('/sectionSort', 'Admin\SectionsController@index')->name('sectionSort');
    Route::post('/sectionSort', 'Admin\SectionsController@store')->name('sectionSort.store');
});


Route::group(['middleware' => ['permission:control aboutUs section']], function () {
    Route::get('/aboutUs', 'Admin\SectionsController@about')->name('aboutUs');
});


Route::group(['middleware' => ['permission:edit sections setting|control aboutUs section']], function () {
    Route::put('/section/setting', 'Admin\SectionsController@update')->name('section.setting.update');
    Route::put('/section/setting/course', 'Admin\SectionsController@updateCourse')->name('section.setting.updateCourse');
    Route::post('/serviceMainDescription', 'Admin\SectionsController@updateMainDesc')->name('updateMainDesc');
});
Route::group(['middleware' => ['permission:control partners section']], function () {
    Route::get('partners', 'Admin\PartnersController@partners')->name('partners');
    Route::post('partners', 'Admin\PartnersController@store')->name('partners.store');
    Route::post('partnersLogo', 'Admin\PartnersController@storeLogo')->name('partners.storeLogo');
    Route::get('partnersLogo', 'Admin\PartnersController@logo');
    Route::get('images', 'Admin\PartnersController@showImages');
    Route::get('deleteLogo/{image}', 'Admin\PartnersController@delete')->name('deleteLogo');
    Route::get('deleteBackground/{image}', 'Admin\PartnersController@deleteBackground')->name('deleteBackground');
    Route::put('updateLogo/{image}', 'Admin\PartnersController@update')->name('updateLogo');
});


Route::get('profile', 'Admin\SettingsController@editProfile')->name('profile.edit');
Route::post('updateProfile', 'Admin\SettingsController@updateProfile')->name('profile.update');

Route::group(['middleware' => ['permission:control blog section']], function () {
    Route::get('/post/{id}', 'Admin\PostsController@destroy')->name('post.destroy');

    Route::resource('posts', 'Admin\PostsController');
    Route::resource('BlogCategory', 'Admin\BlogCategoryController');
    Route::get('/catBlog/{id}', 'Admin\BlogCategoryController@destroy')->name('catBlog.destroy');
    Route::get('/blogCategorySetting', 'Admin\BlogCategoryController@setting');
});

Route::group(['middleware' => ['permission:control service section']], function () {
    Route::get('service', 'Admin\PostsController@service')->name('service');
    Route::get('createService', 'Admin\PostsController@serviceCreate')->name('service');
    Route::get('/service/{id}', 'Admin\PostsController@destroy')->name('service.destroy');
    Route::get('/serviceSetting', 'Admin\PostsController@setting');
});
/************** feature route ***************/
Route::group(['middleware' => ['permission:control feature section']], function () {
    Route::resource('/feature', 'Admin\FeatureController');
    Route::get('/feature/{feature}', 'Admin\FeatureController@destroy')->name('feature.destroy');
    Route::get('/featureSetting', 'Admin\FeatureController@featureSetting');
});
/************** end feature route ***************/
/************** packages route ***************/
Route::group(['middleware' => ['role:admin']], function () {
    Route::resource('/package', 'Admin\PackageController');
    Route::get('/packages/{package}', 'Admin\PackageController@destroy')->name('package.destroy');
    Route::post('/packageTime', 'Admin\PackageController@packageTime')->name('packageTime.store');
});
/************** end feature route ***************/

/********** product *********/
//Route::group(['middleware' => ['permission:control products section']], function () {
Route::resource('courses', 'Admin\CoursesController');
Route::get('liveCourses/', 'Admin\CoursesController@liveCourses')->name('liveCourses.index');
Route::get('liveCourses/show/{course}', 'Admin\CoursesController@showLiveCourses')->name('liveCourses.show');
Route::resource('lessons', 'Admin\LessonsController');
Route::get('/lessons/{id}/destroy', 'Admin\LessonsController@destroy')->name('lesson.destroy');

Route::get('lesson/edit/{id}', 'Admin\LessonsController@edit')->name('admin.lessons.edit');
Route::post('lessons/upload', 'Admin\LessonsController@upload')->name('lessons.upload');
Route::get('/courses/{id}/destroy', 'Admin\CoursesController@destroy')->name('course.destroy');
Route::get('/courses/{id}/addLesson', 'Admin\LessonsController@create')->name('course.lesson.create');
Route::post('/courses/addChapter', 'Admin\ChapterController@store')->name('course.chapter.store');
Route::get('/courses/delChapter/{id}', 'Admin\ChapterController@destroy')->name('course.chapter.destroy');
Route::put('/courses/chapter/update/{chapter}', 'Admin\ChapterController@update')->name('course.chapter.update');
Route::get('deleteImage/{media}', 'Admin\CoursesController@deleteImage')->name('course.deleteImage');
Route::get('chapter/show/{id}', 'Admin\ChapterController@show')->name('chapter.show');

Route::resource('question', 'Admin\QuestionController');
Route::resource('exams', 'Admin\ExamController');
Route::get('/exam/{exam}/delete', 'Admin\ExamController@destroy')->name('exam.delete');

Route::get('/exam/section/{section}', 'Admin\ExamController@showSection')->name('exam.section.show');
Route::post('/exam/section/{section}', 'Admin\ExamController@updateSection')->name('exam.section.update');
Route::post('/exam/section/', 'Admin\ExamController@addSection')->name('exam.section.store');

Route::post('setPlacementTest', 'Admin\ExamController@setPlacementTest')->name('exam.setPlacementTest');

Route::post('/selectQuestion', 'Admin\QuestionController@getFromBank')->name('question.getFromBank');
Route::post('/selectQuestion/{section}', 'Admin\ExamController@getFromBank')->name('section.question.getFromBank');
Route::get('section/deleteQuestion/{section}/{question}', 'Admin\ExamController@deleteFromSection')->name('section.question.delete');

Route::get('/courses/{id}/addQuestion', 'Admin\QuestionController@createToCourse')->name('course.question.create');
Route::get('/chapter/{id}/addQuestion', 'Admin\QuestionController@createToChapter')->name('chapter.question.create');
Route::get('/lesson/{id}/addQuestion', 'Admin\QuestionController@createToLesson')->name('lesson.question.create');

Route::get('/courses/{id}/delete', 'Admin\QuestionController@delete')->name('course.question.delete');
Route::post('/courses/multiDelete', 'Admin\QuestionController@multiDelete')->name('course.question.multiDelete');

Route::get('chapters/{chapter}', 'Admin\QuestionController@chapter_question');

Route::get('question/edit/{id}', 'Admin\QuestionController@edit')->name('admin.question.edit');
Route::post('question/update', 'Admin\QuestionController@update')->name('question.update');


//});

///********** classes *********/
//Route::group(['middleware' => ['permission:control products section']], function () {
Route::resource('classes', 'Admin\ClassesController');
Route::get('classes/create/{request_id}', 'Admin\ClassesController@createFromRequests')->name('class.createFReq');
Route::get('/classes/{id}/delete', 'Admin\ClassesController@destroy')->name('class.destroy');
Route::post('class/lesson/{lesson}', 'Admin\ClassesController@updateLesson')->name('class.lesson.update');
Route::get('class/lesson/{lesson}/{status}', 'Admin\ClassesController@changeStatus')->name('class.lesson.status.change');

//});

Route::group(['middleware' => ['permission:control productCategory section']], function () {
    Route::resource('categoryCourse', 'Admin\CategoryCourseController');
    Route::get('/catCourse/{id}', 'Admin\CategoryCourseController@destroy')->name('catCourse.destroy');
    Route::get('courseSetting', 'Admin\CategoryCourseController@setting');
    Route::get('categories/subCategory/{category}', 'Admin\CategoryCourseController@subCategory');
    Route::get('categories/attributes/{category}', 'Admin\CategoryCourseController@attributes');
});

Route::group(['middleware' => ['permission:approve product']], function () {
    Route::post('course/status/{course}', 'Admin\CoursesController@status')->name('course.status');
});
Route::group(['prefix' => 'attributes'], function () {

    Route::group(['middleware' => ['permission:control attributes']], function () {
        Route::get('all', 'Admin\AttributesController@index')->name('attributes.all');
        Route::post('create', 'Admin\AttributesController@store')->name('attributes.store');
        Route::put('edit/{attribute}', 'Admin\AttributesController@update')->name('attributes.update');
        //        Route::get('delete/{user}', 'Admin\UsersController@destroy')->name('users.destroy');
    });
});
/*********************end products ************/

/*** events ***/
Route::group(['middleware' => ['permission:control event section']], function () {

    Route::resource('events', 'Admin\EventsController');
    Route::post('active/{event}', 'Admin\EventsController@active')->name('active');
    Route::get('/event/{id}', 'Admin\EventsController@destroy')->name('event.destroy');
    Route::get('/eventSetting', 'Admin\EventsController@setting')->name('setting');
});
/*** end events ***/
Route::group(['middleware' => ['permission:control slider section']], function () {
    Route::resource('slider', 'Admin\SliderController');
    Route::get('deleteSlider/{slider}', 'Admin\SliderController@destroy')->name('slider.delete');
});
/* pages */
Route::group(['middleware' => ['permission:control pages section']], function () {
    Route::resource('pages', 'Admin\PagesController');
    Route::get('/pages/{page}', 'Admin\PagesController@destroy')->name('pages.destroy');
});
/* end pages*/
Route::group(['middleware' => ['permission:update website settings']], function () {
    Route::get('settings', 'Admin\SettingsController@edit')->name('settings.edit');
    Route::put('/settings', 'Admin\SettingsController@update')->name('settings.update');
});
//gallery
Route::group(['middleware' => ['permission:control gallery section']], function () {
    Route::resource('category', 'Admin\CategoriesController');
    Route::get('/cat/{id}', 'Admin\CategoriesController@destroy')->name('cat.destroy');
    Route::post('addImage', 'Admin\CategoriesController@addImage')->name('addImage');
    Route::get('categories', 'Admin\CategoriesController@categories')->name('categories');
    Route::get('deleteImage/{image}', 'Admin\CategoriesController@deleteImage')->name('deleteImage');
    Route::put('updateImage/{image}', 'Admin\CategoriesController@updateImage')->name('updateImage');
    Route::get('gallerySetting', 'Admin\CategoriesController@setting');
});
// blog category

/********** themes ***********/
Route::group(['middleware' => ['permission:control themes section']], function () {
    Route::get('themes', 'Admin\ThemesController@index')->name('themes');
    Route::get('activeTheme/{active}', 'Admin\ThemesController@active')->name('activeTheme');
    Route::post('visible', 'Admin\ThemesController@visible')->name('visible');
});
/****** end themes ***********/
/*** teams ***/
Route::group(['middleware' => ['permission:control team section']], function () {

    Route::resource('teams', 'Admin\TeamsController');
    Route::get('/team/{id}', 'Admin\TeamsController@destroy')->name('team.destroy');
    Route::get('/teamSetting', 'Admin\TeamsController@setting')->name('setting');
});
/*** end teams  ***/
/* teacher */
Route::group(['middleware' => ['permission:control teacher section']], function () {
    Route::get('teachers', 'Admin\UsersController@allUsers')->name('teachers');
    Route::get('/review/{user}', 'Admin\UsersController@review')->name('approve.review');
    Route::get('/show/{user}', 'Admin\UsersController@show')->name('showHome.show');
    Route::get('teacher/{user}', 'Admin\UsersController@editUser')->name('teacher.edit');
    Route::post('teacher', 'Admin\UsersController@addTeacher')->name('teacher.store');
    Route::post('edit/{user}', 'Admin\UsersController@updateTeacher')->name('teacher.update');
    Route::get('teacher/pay/{user}', 'Admin\UsersController@payToTeacher')->name('teacher.paid');
    Route::get('teacher/show/{user}', 'Admin\UsersController@showTeacher')->name('teacher.show');
    Route::get('siteUser/delete/{user}', 'Admin\UsersController@deleteUser')->name('site.user.delete');
});
/* student*/
Route::group(['middleware' => ['permission:control student section']], function () {
    Route::get('students', 'Admin\UsersController@allstudent');
    Route::post('students', 'Admin\UsersController@addStudent')->name('student.store');
    //    Route::get('/review/{user}', 'Admin\UsersController@review')->name('approve.review');
    Route::get('student/show/{user}', 'Admin\UsersController@showStudent')->name('student.show');
});
/* order and request */
Route::get('orders', 'Admin\OrderController@index')->name('orders');
Route::get('orders/review/{order}', 'Admin\OrderController@review')->name('orders.review');
Route::get('orders/{order}/{status}', 'Admin\OrderController@update')->name('orders.update');


Route::get('requestClasses', 'Admin\RequestsController@classes')->name('requestClasses');
Route::get('requests/{id}', 'Admin\RequestsController@destroy')->name('request.destroy');
/*contact us */
Route::get('message', 'Admin\MessagesController@index')->name('message');
Route::get('jobs', 'Admin\MessagesController@jobs')->name('jobs');


/* media */
Route::get('media', 'Admin\mediaController@index')->name('media');
Route::post('mediaUpload', 'Admin\mediaController@store')->name('mediaUpload');
Route::get('mediaDelete/{media}', 'Admin\mediaController@destroy')->name('mediaDelete');

//accounting
Route::prefix('voucher')->group(function () {
    Route::group(['middleware' => ['permission:read voucher']], function () {
        Route::get('all', 'Admin\VoucherController@index')->name('voucher.all');
        Route::post('all', 'Admin\VoucherController@index')->name('voucher.filter');
        Route::get('categories', 'VoucherCategoriesController@index')->name('voucher.category.all');
    });
    Route::group(['middleware' => ['permission:create voucher']], function () {
        Route::get('create', 'VoucherController@create')->name('voucher.create');
        Route::post('create', 'Admin\VoucherController@store')->name('voucher.store');
        Route::get('destroy/{voucher}', 'Admin\VoucherController@destroy')->name('voucher.destroy');

        Route::post('category/create', 'VoucherCategoriesController@store')->name('voucher.category.store');
        Route::post('category/{category}', 'VoucherCategoriesController@update')->name('voucher.category.update');
    });
    Route::group(['middleware' => ['permission:read voucher']], function () {
        Route::get('{voucher}', 'VoucherController@show')->name('voucher.show');
    });

    Route::prefix('income')->group(function () {
        Route::group(['middleware' => ['permission:read voucher']], function () {
            Route::get('all', 'Admin\VoucherController@income')->name('voucher.income.all');
            Route::post('all', 'Admin\VoucherController@income')->name('voucher.income.filter');
        });
    });
});
