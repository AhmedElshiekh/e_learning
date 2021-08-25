<?php

namespace App\Http\Resources;

use App\CategoryCourse;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryLevelTwoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $subCategory = CategoryCourse::where('parent_id', $this->id)->where('level' , 3)->get();

        if ($this->resource) :
            $data = [
                'key'           => $this->id,
                'name'          => $this->name,
                'level'         => $this->level,
                'image'         => $this->hasMedia('catCourse') ? $this->firstMedia('catCourse')->getUrl():null,
                'endCategory'   => count($subCategory) > 0 ? CategoryLevelEndResource::collection($subCategory) : null
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
