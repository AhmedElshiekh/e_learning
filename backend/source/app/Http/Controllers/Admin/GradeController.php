<?php

namespace App\Http\Controllers\Admin;

use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::all();
        return view('admin.grades.index', compact('grades'));
    }
    public function create()
    {

        return view('admin.grades.create');
    }
    public function store(Request $request)
    {
        foreach(config('locales') as $locale){
            $request->validate([
                'name_'.$locale => 'required'
            ]);
        }
        $grade = new Grade();
        foreach(config('locales') as $locale){
            $grade->setTranslation('name', $locale,  $request->input('name_'.$locale));
        }
        $grade->save();
        return redirect()->back()->with('success', "Grade $grade->name added successfully");
    }

//    public function show()
//    {
//        return view('ecommerce::admin.Grades.show');
//    }

    public function edit(Grade $grade)
    {

        return view('admin.grades.edit', compact('grade'));
    }

    public function update(Request $request, Grade $grade)
    {
        foreach(config('locales') as $locale){
            $request->validate([
                'name_'.$locale => 'required'
            ]);
        }
        foreach(config('locales') as $locale){
            $grade->setTranslation('name', $locale,  $request->input('name_'.$locale));
        }

        $grade->save();


        return redirect()->route('admin.grade.index')->with('success', "Grade $grade->type updated successfully");
    }

    public function destroy(Grade $grade)
    {
//        if($grade->products()->count() < 1){
            $grade->delete();
            return redirect()->back()->with('success', "Grade $grade->name removed successfully");
//        }else{
//            return redirect()->back()->with('error', "this Grade has products");
//        }

    }
}
