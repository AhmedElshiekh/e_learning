<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

// Route::domain(env('APP_ADMIN_URL'))->group(function ($router) {

    Route::get('/', function () {
       return redirect(url('admin/home'));
    });
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
        Route::post('/login', 'AdminAuth\LoginController@login');
        Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');

        Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
        Route::post('/register', 'AdminAuth\RegisterController@register');

        Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
        Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
        Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
        Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
    });
// });

// Route::any('/',  function () {
//     return view('frontend.dist.index');
// })->where('any', '.*');


// /*route front end */
// Route::get('/','Frontend\HomeController@index')->name('site');
// Route::get('pages/{slug}','Frontend\HomeController@page')->name('pages');
// Route::get('portfolio','Frontend\HomeController@portfolio')->name('portfolio');
// Route::get('blog','Frontend\HomeController@blogg')->name('blog');
// Route::get('blog/{post}','Frontend\HomeController@blog')->name('blog');
// Route::get('categoryBlog','Frontend\HomeController@categoriesBlog')->name('categoryBlog');
// Route::get('categoryBlog/{category}','Frontend\HomeController@categoryBlog')->name('categoryBlog');

// /******** cat course **********/
// Route::get('categoryCourse','Frontend\HomeController@categoriesCourse')->name('categoryCourse');
// Route::post('categoryCourse','Frontend\HomeController@categoriesCourse')->name('categoryCourse.filter');
// Route::get('search/course','Frontend\HomeController@search')->name('courses.search');
// Route::get('showCategory/{category}','Frontend\HomeController@coursesCategory')->name('courses');
// Route::get('/categories/subCategory/{category}','Frontend\HomeController@subCategory')->name('subCategory');
// Route::get('course/{course}','Frontend\HomeController@course')->name('course');
// Route::get('checkStock/{course}/{value}','Frontend\OrderController@checkStock')->name('checkStock');

// /**********  end cat course *********/
// Route::get('about','Frontend\HomeController@about')->name('about-us');
// Route::get('pricing','Frontend\HomeController@pricing')->name('pricing');
// //Route::get('about-us',function (aboutUs){
// //
// //    return view('frontend.'.setting('theme.site').'.about-us',compact('aboutUs')) ;
// //});
// Route::get('service','Frontend\HomeController@services')->name('service');
// Route::get('service/{service}','Frontend\HomeController@service')->name('service');
// Route::get('contactUs',function (){
//     return view('frontend.'.setting('theme.site').'.contactUs') ;
// });
// Route::get('/sectionSort','Frontend\HomeController@sortSection')->name('sectionSort');

// Route::get('lang/{locale}', 'LocalizationController@index')->name('language.change');
// //Route::get('/','Frontend\HomeController@index')->name('home');

// /************** events *********/
// Route::get('events','Frontend\HomeController@event')->name('events');
// Route::get('eventDetails/{event}','Frontend\HomeController@eventDetails')->name('eventDetails');
// /* course order form */
// Route::group(['middleware' => 'auth'], function () {
//     Route::post('order', 'Frontend\OrderController@store')->name('order.store');
//     Route::post('freeDemo', 'Frontend\OrderController@freeDemo')->name('freeDemo');

//     //payment
//     Route::post('payment', 'Frontend\PayPalController@payment')->name('package.payment');
//     Route::get('cancel', 'Frontend\PayPalController@cancel')->name('payment.cancel');
//     Route::get('payment/success', 'Frontend\PayPalController@success')->name('payment.success');

//     Route::get('/home', 'HomeController@index')->name('home');
//     Route::get('/myAccount', 'HomeController@myAccount')->name('myAccount');
//     //classes
//     Route::get('/myClasses', 'HomeController@myClasses')->name('myClasses');
//     Route::get('/class/{course}', 'HomeController@showClass')->name('class.show');
//     Route::get('/class/{course}/{status}', 'HomeController@approveClass')->name('class.approve');
//     Route::post('complete/class/{lesson}', 'HomeController@completeClass')->name('class.complete');

//     Route::post('/updateProfile}', 'HomeController@update')->name('profile.update');
//     Route::get('/appointments', 'Frontend\TeacherController@appointments')->name('teacher.appointments');
//     Route::post('/appointments}', 'Frontend\TeacherController@updateAppointments')->name('teacher.appointments.update');


// });
// /************** teams *********/
// Route::get('teams','Frontend\HomeController@team')->name('teams');
// Route::get('teamDetails/{team}','Frontend\HomeController@teamDetails')->name('teamDetails');

// //service request
// Route::post('request','Frontend\RequestsController@store')->name('request');
// //contact us
// Route::post('message','Frontend\MessagesController@store')->name('message');

// Route::post('jopApply','Frontend\HomeController@jopApply')->name('jopApply');

// Auth::routes();
// Route::get('/teacher/login', 'Auth\LoginController@showTeacherForm')->name('teacher.login');
// Route::get('/teacherDetails/{teacher}', 'Frontend\HomeController@teacherDetails')->name('teacherDetails');

