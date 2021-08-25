<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\ZoomMeetingTrait;
use App\Models\Classes;
use App\Models\ClassLesson;
use App\Models\ZoomMeeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZoomMeetingController extends Controller
{
    use ZoomMeetingTrait;
    use ApiResponseTrait;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;


    public function show($id)
    {
        $user = Auth::user();
        $meeting = ZoomMeeting::where('class_lesson_id', $id)->latest()->first();

        if ($user && $meeting) :
            $teacher = ClassLesson::find($id)->lessonClass->course->teacher;
            $role = $teacher == $user ? 1 : 0;

            $data = [
                'meetingID'         => $meeting->meetingID,
                'nickname'          => $user->name,
                'password'          => $meeting->password,
                'start_time'        => $meeting->start_time,
                'role'              => $role,
            ];

            return $this->apiResponse($data, 201, 'create zoom meeting ,done');
        endif;

        return $this->apiResponse(null, 400, 'you should be login');
    }


    public function store(Request $request)
    {
        $user = Auth::user();

        $lesson = ClassLesson::find($request->lesson_key);
        $duration = $lesson->lessonClass->session_time;
        // dd($lesson);

        if ($user) :
            $lesson->setAttribute('duration', $duration);
            $lesson->setAttribute('timezone', $request->timezone);

            $create = $this->create($lesson);
            $meeting = ZoomMeeting::create([
                'class_lesson_id'   => $request->lesson_key,
                'meetingID'         => $create['data']['id'],
                'topic'             => $create['data']['topic'],
                'type'              => $create['data']['type'],
                'start_time'        => $create['data']['start_time'],
                'start_url'         => $create['data']['start_url'],
                'join_url'          => $create['data']['join_url'],
                'password'          => $create['data']['password'],
            ]);

            if ($meeting) :

                $data = [
                    'meetingID'         => $meeting->meetingID,
                    'nickname'          => $user->name,
                    'password'          => $meeting->password,
                    'start_time'        => $meeting->start_time,
                    'role'              => 1,
                ];

                return $this->apiResponse($data, 201, 'create zoom meeting ,done');
            endif;
        endif;

        return $this->apiResponse(null, 400, 'you should be login');
        // return redirect()->route('meetings.index');
    }



    public function zoomCredential()
    {
        $user = Auth::check();

        if ($user) :
            $data = [
                'api_key'    => env('ZOOM_API_KEY', ''),
                'api_secret' => env('ZOOM_API_SECRET', ''),
            ];

            return $this->apiResponse($data, 200);
        endif;

        return $this->apiResponse(null, 400, 'you should be login');
    }

    public function flutterZoomCredential()
    {
        $user = Auth::check();

        if ($user) :
            $data = [
                'sdk_key'    => env('ZOOM_SDK_KEY', ''),
                'sdk_secret' => env('ZOOM_SDK_SECRET', ''),
            ];

            return $this->apiResponse($data, 200);
        endif;

        return $this->apiResponse(null, 400, 'you should be login');
    }


    public function update($meeting, Request $request)
    {
        $this->update($meeting->zoom_meeting_id, $request->all());

        return redirect()->route('meetings.index');
    }


    public function destroy($lessonID)
    {
        $meetings = ZoomMeeting::where('class_lesson_id', $lessonID)->get();

        $lesson = ClassLesson::find($lessonID);
        $lesson->status = "finished";
        $lesson->save();

        foreach ($meetings as $meeting) :
            $this->delete($meeting->meetingID);
            $meeting->delete();
        endforeach;

        if ($lesson) :
            return $this->apiResponse(null, 200);
        endif;

        return $this->apiResponse(null, 400, 'failed');
    }
}
