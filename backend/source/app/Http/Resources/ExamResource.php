<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
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
                'key'                   => $this->id,
                'title'                 => $this->title,
                'time'                  => $this->time,
                'sections_count'        => $this->sections_count,
                'sections'              => ExamSectionResource::collection( $this->sections),
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
