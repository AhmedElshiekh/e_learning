<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $sections = ResultSectionExamResource::collection($this->sections);
        if ($this->resource) :
            $data = [
                'key'                   => $this->id,
                'title'                 => $this->exam->title,
                'score'                 => $this->score,
                'total'                 => $this->total,
                'pass'                  => $this->pass,
                'rate'                  => $this->rate,
                'sections'              => $sections,
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
