<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CoursesResource extends JsonResource
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
                'name'                  => $this->name,
                'slug'                  => $this->slug,
                'image'                 => $this->hasMedia('Course') ? $this->firstMedia('Course')->getUrl() : null,
                'short_description'     => $this->sh_desc,
                'price'                 => $this->price,
                'level'                 => $this->level->name,
                'discountPrice'         => $this->discountPrice,
                'teachers'              => TeacherResource::collection($this->teachers),
                // 'teacher_img'           => $this->teacher->hasMedia('userAvatar') ? $this->teacher->firstMedia('userAvatar')->getUrl():null
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
