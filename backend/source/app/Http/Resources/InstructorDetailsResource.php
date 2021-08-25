<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstructorDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->resource) :
            $data = [
                'key'               =>  $this->id,
                'name'              =>  $this->name,
                'video'             =>  $this->video,
                'gender'            =>  $this->gender,
                'country'           =>  $this->country,
                'qualifications'    =>  $this->qualifications,
                'whatsApp'          =>  $this->whatsApp,
                'facebook'          =>  $this->facebook,
                'image'             =>  $this->hasMedia('userAvatar') ? $this->firstMedia('userAvatar')->getUrl():null,
                'courses'           =>  CoursesResource::collection($this->coursesTeacher->where('type', 'recorded')),
                'liveCourses'       =>  LiveCoursesResource::collection($this->coursesTeacher->where('type', 'live')),
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
