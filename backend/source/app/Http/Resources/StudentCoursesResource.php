<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class StudentCoursesResource extends JsonResource
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
            $exam = Auth::user()->exams;

            $data = [
                'key'                   => $this->id,
                'name'                  => $this->name,
                'slug'                  => $this->slug,
                'image'                 => $this->hasMedia('Course') ? $this->firstMedia('Course')->getUrl() : null,
                'short_description'     => $this->sh_desc,
                'price'                 => $this->price,
                'level'                 => $this->level->name,
                'discountPrice'         => $this->discountPrice,
                'teachers'              => TeacherResource::collection($this->teachers),
                'placement'             => $exam ? new ScoreResource( $exam->where('exam_id', $this->exam_id)->first() ) :null,
                'exam'                  => $exam ? new ScoreResource( $exam->where('exam_id', $this->placementTest_id)->first() ) :null,
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
