<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultSectionExamResource extends JsonResource
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
                'title'                 => $this->section->name,
                'score'                 => $this->score,
                'total'                 => $this->total,
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
