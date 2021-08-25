<?php

namespace App\Http\Controllers\Frontend;

use App\BlogCategory;
use App\CategoryCourse;
use App\Category;
use App\Country;
use App\Event;
use App\Feature;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Package;
use App\Models\PackageTime;
use App\Page;
use App\Partner;
use App\Post;
use App\Course;
use App\Section;
use App\Slider;
use App\Team;
use App\coursesCategory;
use App\Testmonial;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use MediaUploader;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $slider  = Slider::all();

        $categories=Category::all();
        $aboutUs = Section::Where('type','about')->first();
        $features=Feature::all();
        $featureSetting =Section::Where('type','feature')->first();
        $activeSection=Section::Where('active',1)->orderBy('order')->get();
        $catCourse= Section::Where('type','catCourse')->first();

        $courses=Course::where('status',1)->where('type', 'recorded')->with('categoryCourse')->with('parentCategory')->get()->take(12);
        $liveCourses=Course::where('status',1)->where('type', 'live')->with('categoryCourse')->with('parentCategory')->get()->take(3);

        $categoriesCourse=CategoryCourse::where('parent_id','!=', null)->get();


        $teachers =User::Where(['type'=>'teacher'])->get();
        $students =User::Where(['type'=>'student'])->get();

        return view('frontend.'.setting('theme.site').'.index',
        compact('slider','categories','aboutUs','features','featureSetting','activeSection','courses',
        'categoriesCourse','catCourse','teachers','students', 'liveCourses'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function about(){
        $aboutUs = Section::Where('type','about')->first();
        $features=Feature::all()->take(4);
        $featureSetting =Section::Where('type','feature')->first();
        $partnersLogo=Partner::where('type','partnersLogo')->get();

        return view('frontend.'.setting('theme.site').'.about-us',compact('aboutUs','features','featureSetting','partnersLogo'));
    }

    public function page($slug)
    {
        $page = Page::where('slug',$slug)->first();
        $slider=Slider::all();
        return view('frontend.'.setting('theme.site').'.page',compact('page','slider'));
    }

    public function portfolio(){
        $categories=Category::all();
        $gallary = Section::Where('type','portfolio')->first();
        return view('frontend.'.setting('theme.site').'.portfolio',compact('categories','gallary'));
    }

    /** view blog  */
    public function blogg(BlogCategory $category){
        $posts =Post::Where('type','post')->get();
        return view('frontend.'.setting('theme.site').'.blogg',compact('posts','category'));
    }

    public function categoryBlog(BlogCategory $category){
        $posts =$category->posts()->paginate(21);
        $categoryText = Section::Where('type','blog')->first();
        return view('frontend.'.setting('theme.site').'.blogg',compact('category','posts','categoryText'));
    }
    public function categoriesBlog(){
        $categoriesBlog=BlogCategory::all();
        $posts =Post::Where('type','post')->get();
        $categoryText = Section::Where('type','blog')->first();
        return view('frontend.'.setting('theme.site').'.categoryBlog',compact('categoriesBlog','categoryText','posts'));

    }

    public function blog(Post $post)
    {
        $cat = $post->categoryBlog;

        $posts =$cat->posts->except($post->id)->take(5);
        return view('frontend.'.setting('theme.site').'.blog',compact('post','posts'));
    }
    public function categoriesCourse(Request $request){

        $categoriesCourse=CategoryCourse::whereNull('parent_id')->get();

        $catCourse=Section::Where('type','catCourse')->first();
        if ($request->method() == 'GET') {
            $products = Course::where('status', 1)->paginate(16);
        }else{
            if ($request->subCategory !== 'all'  ){
                $products = Course::where('status', 1)->where('product_cat_id',$request->subCategory)->paginate(16);
            }else{
                $products = Course::where('status', 1)->paginate(16);
            }
        }
        return view('frontend.'.setting('theme.site').'.catproduct',compact('categoriesProduct','catProduct','products'));
    }


    public function subCategory(CategoryCourse $category )
    {
        $sub  = $category->children()->pluck('name','id');
        return  json_encode($sub);
    }
   public function search(Request $request )
    {

        $categoriesCourse=CategoryCourse::whereNull('parent_id')->get();
        $catCourse=Section::Where('type','catCourse')->first();

        $name = $request->search;
//        dd($name);
//        $products = Product::where('name', 1)->paginate(16);
        if( \App::isLocale('ar')){

            $courses = Course::where('name->ar', 'like', '%' . $name . '%')->where(['status' => 1])->paginate(1);
        }else{
            $courses = Course::where(['status' => 1])->where('name->en', 'like', '%' . $name . '%')->paginate(16);
        }
//dd($products);
        return view('frontend.'.setting('theme.site').'.catcourse',compact('categoriesProduct','catCourse','courses'));
    }
     public function course($slug){
        $course = Course::where('slug',$slug)->firstOrFail();
        $cat= $course->categoryProduct;
        $courses= $cat->products;
        return view('frontend.'.setting('theme.site').'.course',compact('course','courses'));
     }
    public function coursesCategory( $slug){
           $category = CategoryCourse::where('slug',$slug)->firstOrFail();
            $courses= $category->courses()->where('status',1)->paginate(21);
//            $catProduct=Section::Where('type','catProduct')->first();

//            $subCategories= $category->children()->paginate(9);

            return view('frontend.'.setting('theme.site').'.courses',compact('category','courses'));


    }

    public function services(){
        $service =Post::Where('type','service')->get();
        $mainServiceDesc = Section::Where('type','service')->first();
        return view('frontend.'.setting('theme.site').'.service',compact('service','mainServiceDesc'));
    }
    public function service(Post $service)
    {
        $services =Post::Where('type','service')->get()->except($service->id);
        $mainServiceDesc = Section::Where('type','service')->first();
        return view('frontend.'.setting('theme.site').'.service-detailes',compact('services','service','mainServiceDesc'));
    }

    // public function event(){
    //     $events=Event::where('active',1)->paginate(21);
    //     $eventSection=Section::Where('type','event')->first();
    //     return view('frontend.'.setting('theme.site').'.event',compact('events','eventSection'));
    // }

    // public function eventDetails(Event $event){

    //     $events=Event::get()->except($event->id)->take(5);
    //     $eventSection=Section::Where('type','event')->first();
    //     return view('frontend.'.setting('theme.site').'.eventDetails',compact('event','events','eventSection'));
    // }


    public function team(){
        $teams=Team::all();
        $teamSection=Section::Where('type','teams')->first();
        return view('frontend.'.setting('theme.site').'.teams',compact('teams','teamSection'));
    }
    public function pricing(){
        $packageTimes=PackageTime::whereHas('packages')->get();
        $packages = Package::all();
        return view('frontend.'.setting('theme.site').'.pricing',compact('packageTimes','packages'));
    }
    public function teamDetails(Team $team){

        $teams=Team::get()->except($team->id)->take(5);
        $teamSection=Section::Where('type','team')->first();
        return view('frontend.'.setting('theme.site').'.teamDetails',compact('teams','team','teamSection'));
    }
 /* teacherDetails */
    public function teacherDetails(User $teacher){
        return view('frontend.'.setting('theme.site').'.teacher-det',compact('teacher'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sortSection()
    {
        $activeSection=Section::Where('active',1)->orderBy('order')->get();
    }
    public function jopApply(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'job_field'=>'required',
            'cv'=>'required|file|mimes:pdf,doc,docx',
        ]);
        $jop = Job::create($request->all());
        if($request->file('cv'))
        {
            $media = MediaUploader::fromSource($request->file('cv'))->upload();
            $jop->attachMedia($media, 'cv');
        }
        return redirect()->back()->with('success','Done');
    }
}
