<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherClassesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $firstClass = $this->classes->where('private', false)->first() ?? null;

        if ($this->resource) :

            $lesson = $firstClass ? $firstClass->lessons->where('status', 'in progress')->first() :null ;
            $data = [
                'key'              => $this->id,
                'name'             => $this->name,
                'type'             => 'public',
                'weeks'            => $firstClass->weeks ?? null,
                'lessons'          => $firstClass ? $firstClass->lessons->count() :null,
                'lessonTime'       => $lesson ? $lesson->date . '|' . $lesson->time : null,
            ];

        else :
            $data = null;
        endif;

        return $data;
    }
}
