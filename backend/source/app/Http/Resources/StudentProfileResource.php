<?php

namespace App\Http\Resources;

use App\Models\Exam;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class StudentProfileResource extends JsonResource
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
            $globalPlacement = Exam::where('global', true)->first();

            $data = [
                'key'                   => $this->id,
                'name'                  => $this->name,
                'image'                 => $this->hasMedia('userAvatar') ? $this->lastMedia('userAvatar')->getUrl() : null,
                'type'                  => $this->type,
                'email'                 => $this->email,
                'phone'                 => $this->phone,
                'country'               => $this->country,
                'placementTest'         => $globalPlacement ? new ScoreResource( $exam->where('exam_id', $globalPlacement->id )->first() ) :null,
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
