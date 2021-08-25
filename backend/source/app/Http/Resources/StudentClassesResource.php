<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentClassesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $firstClass = $this->classes->where('private', false)->first();

        if ($this->resource and $firstClass) :
            
            $lesson = $firstClass->lessons ? $firstClass->lessons->where('status', 'in progress')->first() :null;
            $data = [
                'key'          => $this->id,
                'name'         => $this->name,
                'type'         => 'public',
                'teachers'     => TeacherResource::collection($this->teachers),
                'weeks'        => $firstClass->weeks ?? null,
                'lessons'      => $firstClass->lessons ? $firstClass->lessons->count() : 0,
                'lessonTime'   => $lesson ? $lesson->date . '|' . $lesson->time : null,
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
