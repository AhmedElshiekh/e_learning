<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExamSectionResource extends JsonResource
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
                'key'        => $this->id,
                'title'      => $this->name,
                'questions'  => QuestionsResource::collection($this->questions),
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
