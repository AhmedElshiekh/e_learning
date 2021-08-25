<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChaptersListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $lessons = LessonsListResource::collection($this->lessons);
        if ($this->resource) :
            $data = [
                'key'           => $this->id,
                'name'          => $this->name,
                'quiz'          => $this->questions->count() > 0 ? true : false,
                'LessonsList'   => $lessons,
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
