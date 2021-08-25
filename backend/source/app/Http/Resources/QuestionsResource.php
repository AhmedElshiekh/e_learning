<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionsResource extends JsonResource
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
                'question'              => $this->title,
                'correct_answer'        => $this->correct_answer,
                'correct_answer'        => $this->correct_answer,
                'answers'               => AnswerResource::collection($this->answers)->shuffle(),
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
