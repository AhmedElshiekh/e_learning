<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\TwilioTrait;
use App\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{
    use ApiResponseTrait;
    use TwilioTrait;

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if(!$user):
            return $this->apiResponse(null, 400, 'you should login');
        endif;

        $validate = Validator::make($request->all(), [
            'teacher_id'    => 'required|integer',
            'course_id'     => 'nullable|integer',
            'start_date'    => 'nullable|date',
            'note'          => 'nullable'
        ]);

        if ($validate->fails()) : // return '422' UnProcessable Entity
            return $this->apiResponse(null, 422, $validate->errors());
        endif;

        
        $request->request->add(['user_id' => $user->id]);
        $req = Requests::Create($request->all());

        if($req):
            $this->SendRequestClass($req->user->phone);
            return $this->apiResponse($req , 201);
        endif;

        return $this->apiResponse(null, 400, 'error');

    }

    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        //
    }
}
