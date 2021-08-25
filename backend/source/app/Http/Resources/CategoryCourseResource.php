<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryCourseResource extends JsonResource
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
                'key'           => $this->id,
                'name'          => $this->name,
                'slug'          => $this->slug,
                'image'         => $this->hasMedia('catCourse') ? $this->firstMedia('catCourse')->getUrl():null,
                'description'   => $this->desc,
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
