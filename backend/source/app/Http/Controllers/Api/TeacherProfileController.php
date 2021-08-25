<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeacherProfileResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Plank\Mediable\Facades\MediaUploader;

class TeacherProfileController extends Controller
{
    use ApiResponseTrait;

    public function update(Request $request)
    {
        $request->validate([
            'name'              => 'nullable',
            // 'img'               => 'nullable|image|mimes:jpg,png,jpeg,svg|max:30048',
            'email'             => 'nullable',
            'phone'             => 'nullable',
            'country'           => 'nullable',
            'qualifications'    => 'nullable',
            'whatsApp'          => 'nullable',
            'facebook'          => ' nullable',
            'password'          => 'nullable|max:25|min:6|confirmed',
            'oldPassword'       => 'string|nullable',
            'newPassword'       => 'nullable|string|confirmed'

        ]);
        $user = Auth::user();
        $user->name             = $request->get('name');
        $user->email            = $request->get('email');
        $user->phone            = $request->get('phone');
        $user->country          = $request->get('country');
        $user->qualifications   = $request->get('qualifications');
        $user->facebook         = $request->get('facebook');
        $user->whatsApp         = $request->get('whatsApp');

        if ($request->oldPassword):
            if (Hash::check($request->oldPassword, $user->password)) {
                $user->password = Hash::make($request->newPassword);
            } else {
                return $this->apiResponse(null, 404, 'invalid old Password');
            }
        endif;
        // if($request->file('img')):
        //     $media = MediaUploader::fromSource($request->file('img'))->upload();
        //     $user->attachMedia($media, 'userAvatar');
        // endif;

        $user->save();

        if ($user) :
            $data = new TeacherProfileResource($user);
            return $this->apiResponse($data, 200, 'success');
        endif;

        // if all failed return error 404
        return $this->apiResponse(null, 404, 'You should login');
    }
}
