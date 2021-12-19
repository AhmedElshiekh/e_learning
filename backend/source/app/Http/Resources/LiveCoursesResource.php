<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LiveCoursesResource extends JsonResource
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
                'image'                 => $this->hasMedia('Course') ? $this->lastMedia('Course')->getUrl() : null,
                'short_description'     => $this->sh_desc,
                'price'                 => $this->price,
                'level'                 => $this->level->name,
                'discountPrice'         => $this->discountPrice,
                'teachers'              => TeacherResource::collection($this->teachers),
                // 'teacher_img'           => $this->teacher->hasMedia('userAvatar') ? $this->teacher->lastMedia('userAvatar')->getUrl():null,
                'category'              => $this->parentCategory->name.'/'.$this->categoryCourse->name,
                'start_time'            => $this->classes->where('private',false)->first()->start_from ?? null,
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
