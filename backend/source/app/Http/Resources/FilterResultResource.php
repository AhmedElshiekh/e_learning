<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FilterResultResource extends JsonResource
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
                'type'                  => $this->type,
                'image'                 => $this->hasMedia('Course') ? $this->firstMedia('Course')->getUrl() : null,
                'short_description'     => $this->sh_desc,
                'level'                 => $this->level->name,
                'price'                 => $this->price,
                'discountPrice'         => $this->discountPrice,
                'category'              => $this->parentCategory->name . '/' . $this->categoryCourse->name,
                'start_time'            => $this->classes->where('private', false)->first()->start_from ?? null,
                'teachers'              => TeacherResource::collection($this->teachers),
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
