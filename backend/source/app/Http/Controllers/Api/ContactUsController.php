<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Http\Traits\ApiResponseTrait;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{

    use ApiResponseTrait;

    public function contactUs()
    {
        $data = [
            'phone'         => setting('general.phone_number'),
            'email'         => setting('general.contact_email'),
            'address'       => setting('general.address'),
            'location'      => setting('general.map_iframe_link'),
        ];

        if ($data) :
            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }



    public function message(Request $request)
    {

        $user = Auth::user();

        if ($user) :

            $request->name  = $user->name;
            $request->email = $user->email;
            $request->phone = $user->phone;

        else :

            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'email|required',
                'phone' => 'required',
                'note' => 'nullable'
            ]);

            if ($validate->fails()) : // return '422' UnProcessable Entity
                return $this->apiResponse(null, 422, $validate->errors());
            endif;

        endif;



        $msg = Message::Create([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'note'  => $request->note,
        ]);

        if ($msg) :
            return $this->apiResponse(new MessageResource($msg), 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'not found');
    }
}
