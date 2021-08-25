<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassLessonResource extends JsonResource
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
            $next = $this->nextLesson;
            $data = [
                'key'           => $this->id,
                'name'          => $this->name,
                'day'           => $this->day,
                'date'          => $this->date,
                'time'          => $this->time,
                'status'        => $this->status,
                'meeting'       => $this->zoomMeeting ? true :false,
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
