<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeachCourseLiveResource extends JsonResource
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
                'price'                 => $this->price,
                'level'                 => $this->level->name,
                'discountPrice'         => $this->discountPrice,// 'teacher_img'           => $this->teacher->hasMedia('userAvatar') ? $this->teacher->firstMedia('userAvatar')->getUrl():null,
                'category'              => $this->parentCategory->name.'/'.$this->categoryCourse->name,
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
