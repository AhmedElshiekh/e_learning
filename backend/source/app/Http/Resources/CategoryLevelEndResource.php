<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryLevelEndResource extends JsonResource
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
                'level'         => $this->level,
                'image'         => $this->hasMedia('catCourse') ? $this->lastMedia('catCourse')->getUrl():null,
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
