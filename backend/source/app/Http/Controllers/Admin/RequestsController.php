<?php

namespace App\Http\Controllers\Admin;

use App\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestsController extends Controller
{

    public function classes()
    {
        $requests = Requests::all();
        foreach ($requests->where('views', 0) as $request) {
            $request->views = 1;
            $request->save();
        }
        return view('admin.classes.request', compact('requests'));
    }


    public function page()
    {
        $requests = Requests::whereNotNull('page_id')->get();
        foreach ($requests->where('views', 0) as $request) {
            $request->views = 1;
            $request->save();
        }
        return view('admin.pages.requests', compact('requests'));
    }

    public function destroy($id)
    {
        $team = Requests::find($id);
        $team->delete();

        return  redirect('admin/requestClasses')->with('deleted', 'Request deleted successfully');
    }
}
