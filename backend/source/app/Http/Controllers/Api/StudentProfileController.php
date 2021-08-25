<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentProfileResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use MediaUploader;

class StudentProfileController extends Controller
{
    use ApiResponseTrait;

    public function update(Request $request)
    {
        $request->validate([
            // 'img'          => 'nullable|image|mimes:jpg,png,jpeg,svg|max:30048',
            'name'         => 'nullable',
            'email'        => 'nullable',
            'password'     => 'nullable|max:25|min:6|confirmed',
            'phone'        => 'nullable',
            'oldPassword'  => 'string|nullable',
            'newPassword'  => 'nullable|string|confirmed'

        ]);

        $user = Auth::user();
        $user->name     = $request->get('name');
        $user->email    = $request->get('email');
        $user->phone    = $request->get('phone');
        $user->country  = $request->get('country');

        // if ($request->file('img')) :
        //     $media = MediaUploader::fromSource($request->file('img'))->upload();
        //     $user->attachMedia($media, 'userAvatar');
        // endif;

        if ($request->oldPassword) {
            if (Hash::check($request->oldPassword, $user->password)) {
                $user->password = Hash::make($request->newPassword);
            } else {
                return $this->apiResponse(null, 404, 'invalid old Password');
            }
        }

        $user->save();

        if ($user) :
            $data = new StudentProfileResource($user);
            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'You should login');
    }

}
