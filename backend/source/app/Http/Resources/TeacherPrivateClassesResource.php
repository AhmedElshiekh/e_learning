<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherPrivateClassesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $lesson = $this->lessons->where('status', 'in progress')->first();
        if ($this->resource) :
            $data = [
                'key'              => $this->id,
                'name'             => $this->course->name,
                'type'             => 'private',
                'weeks'            => $this->weeks,
                'lessons'          => $this->lessons->count(),
                'lessonTime'       => $lesson ? $lesson->date . '|' . $lesson->time : null,
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
