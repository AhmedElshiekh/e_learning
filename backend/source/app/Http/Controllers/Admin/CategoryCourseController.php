<?php

namespace App\Http\Controllers\Admin;;

use App\Section;
use App\CategoryCourse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MediaUploader;

class CategoryCourseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoriesCourses = CategoryCourse::all();
        $categorySection = Section::Where('type', 'catCourse')->first();
        return view('admin.courses.categoriesCourse', compact('categoriesCourses', 'categorySection'));
    }


    public function setting()
    {
        $categorySection = Section::Where('type', 'catCourse')->first();
        return view('admin.courses.setting', compact('categorySection'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoriesCourse = CategoryCourse::whereNull('parent_id')->get();
        return view('admin.courses.createCategoryCourse', compact('categoriesCourse'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'img' => 'mimes:jpg,png,jpeg,svg|max:3000',
        ]);
        foreach (config('locales') as $locale) {
            $request->validate([
                'name_' . $locale => 'required',
                'desc_' . $locale => 'string|nullable',
            ]);
        }
        $parentCategory = CategoryCourse::find($request->input('parentCategory'));

        $categoryCourse = new CategoryCourse();
        $categoryCourse->parent_id = $request->input('parentCategory');
        $categoryCourse->level = $parentCategory ? $parentCategory->level + 1 : 1;

        $count = CategoryCourse::max('id') + 1;
        $categoryCourse->slug = $request->input('name_en') . ' ' . $count;
        //access request data
        foreach (config('locales') as $locale) {
            $categoryCourse->setTranslation('name', $locale,  $request->input('name_' . $locale));
            $categoryCourse->setTranslation('desc', $locale,  $request->input('desc_' . $locale));
        }

        $categoryCourse->save();
        //************************uploade photo*******************
        if ($request->file('img')) {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $categoryCourse->attachMedia($media, 'catCourse');
        }
        return redirect()->back()->with('success', 'Subject  created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function subCategory(CategoryCourse $category)
    {
        return  $sub  = $category->children()->pluck('name', 'id');
        // dd( json_encode($sub));
        //return  json_encode($sub);
    }


    public function attributes(CategoryCourse $category)
    {
        return $sub  = $category->attributes()->pluck('name', 'id');
        // return  json_encode($sub);
    }
    /**
     * Show the form for editing the specified resourc

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
            'img' => 'mimes:jpg,png,jpeg,svg|max:3000',
        ]);
        $request->validate([
            'parentCategory' => 'nullable'
        ]);

        foreach (config('locales') as $locale) {
            $request->validate([
                'name_' . $locale => 'required',
                'desc_' . $locale => 'required',
            ]);
        }
        $categoryCourse = CategoryCourse::find($id);
        $categoryCourse->parent_id = $request->input('parentCategory');

        foreach (config('locales') as $locale) {
            $categoryCourse->setTranslation('name', $locale,  $request->input('name_' . $locale));
            $categoryCourse->setTranslation('desc', $locale,  $request->input('desc_' . $locale));
        }

        $categoryCourse->save();

        //************************uploade photo*******************
        if ($request->file('img')) {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $categoryCourse->attachMedia($media, 'catCourse');
        }
        return redirect()->back()->with('success', 'Subject  updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoryCourse = CategoryCourse::find($id);
        if ($categoryCourse->courses()->count() > 0) {
            return  redirect()->back()->with('error', 'can`t delete this category because it contains courses');
        } else {

            $categoryCourse->delete();
            return  redirect()->back()->with('success', 'Subject  deleted successfully');
        }
    }
}
