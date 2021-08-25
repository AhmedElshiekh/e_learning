<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\CategoryCourse;
use App\Course;
use App\Feature;
use App\Http\Controllers\Controller;
use App\Http\Resources\AboutUsResource;
use App\Http\Resources\CategoryCourseResource;
use App\Http\Resources\CoursesResource;
use App\Http\Resources\FeatureResource;
use App\Http\Resources\LiveCoursesResource;
use App\Http\Resources\SliderResource;
use App\Http\Resources\TeacherResource;
use App\Http\Traits\ApiResponseTrait;
use App\Section;
use App\Slider;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display the specified resource.
     */
    public function slider()
    {
        $slider  = Slider::all();

        if ($slider) :
            return $this->apiResponse(SliderResource::collection($slider), 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }


    /**
     * Show the form for editing the specified resource.
     *
     */
    public function categories()
    {
        $categories = CategoryCourse::where('level', '3')->get();

        if ($categories) :
            return $this->apiResponse(CategoryCourseResource::collection($categories), 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }



    /**
     * Update the specified resource in storage.
     *
     */
    public function features()
    {
        $features = Feature::latest()->take(3)->get();

        if ($features) :
            return $this->apiResponse(FeatureResource::collection($features), 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }




    public function courses()
    {
        $pageLimit = $this->page();

        $courses = [];
        $allCourses = Course::where('status', 1)->where('type', 'recorded')->latest()->paginate($pageLimit);

        $currentPage = $allCourses->currentPage();
        $lastPage    = $allCourses->lastPage();

        foreach ($allCourses as $course) :
            $lessons = $course->lessons;
            count($lessons) > 0 ? array_push($courses, $course) :
            $course->update(["status" => false]) ;
        endforeach;  

        if ($courses) :
            return $this->apiResponse(CoursesResource::collection($courses), 200, 'success', $currentPage, $lastPage);
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }



    public function liveCourses()
    {
        $pageLimit = $this->page();

        $courses = [];
        $allCourses = Course::where('status', true)->where('type', 'live')->latest()->paginate($pageLimit);

        $currentPage = $allCourses->currentPage();
        $lastPage    = $allCourses->lastPage();

        foreach ($allCourses as $course) :
            $class = $course->classes->first();
            $sDate = $class ? $class->start_from : null;
            $date = Carbon::now()->format("Y-m-d");
            $sDate >= $date ? array_push($courses, $course) :
            $course->update(["status" => false]) ;
        endforeach;

        if ($courses) :
            return $this->apiResponse(LiveCoursesResource::collection($courses), 200, 'success', $currentPage, $lastPage );
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }



    public function analysis()
    {

        $courses = Course::where('status', 1)->where('type', 'recorded')->get();
        $classes = Course::where('status', 1)->where('type', 'live')->get();
        $students = User::where('type', 'student')->get();
        $teachers = User::where('type', 'teacher')->get();

        $data = [
            'courses'   => count($courses),
            'classes'   => count($classes),
            'strudents' => count($students),
            'teachers'  => count($teachers),
        ];

        if ($data) :
            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }





    public function teachers()
    {
        $teachers = User::where('type', 'teacher')->where('showHome', true)->get();

        if ($teachers) :
            return $this->apiResponse(TeacherResource::collection($teachers), 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }




    public function aboutUs()
    {
        $about = Section::Where('type', 'about')->first();

        if ($about) :
            return $this->apiResponse(new AboutUsResource($about), 200, 'success');
            return $this->apiResponse($about, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }


    public function global()
    {
        $data = [
            'website_name'  => setting('general.website_name'),
            'logo'          => 'logo/' . setting('general.logo')
        ];

        if ($data) :
            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }



    public function footer()
    {
        $data = [
            'phone'         => setting('general.phone_number'),
            'email'         => setting('general.contact_email'),
            'address'       => setting('general.address'),
            'location'      => setting('general.map_iframe_link'),
            'whatsapp'      => setting('general.whatsapp_number'),
            'facebook'      => setting('general.facebook_page_link'),
            'twitter'       => setting('general.twitter_page_link'),
            'linkedin'      => setting('general.linkedin_page_link'),
            'instagram'     => setting('general.instagram_page_link'),
            'youTube'       => setting('general.youTube_page_link'),
        ];

        if ($data) :
            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }
}
