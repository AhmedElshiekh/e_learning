<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonResourse extends JsonResource
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
            // $next = $this->nextLesson;
            $data = [
                'key'               => $this->id,
                'name'              => $this->topic,
                'video'             => $this->video,
                'objective'         => $this->objective,
                'material'          => $this->material,
                'summary'           => $this->summary,
                'nextLesson'        => $this->nextLesson,
                'exam'              => $this->isQuestion,
                'nextChapter'       => $this->nextChapter,
                'prevTest'          => $this->prevTest,
                'lessonClosed'      => $this->lessonClosed,
                'endQuizLesson'     => $this->lessonStatus,
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
