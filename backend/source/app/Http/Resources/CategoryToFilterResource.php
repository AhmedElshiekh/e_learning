<?php

namespace App\Http\Resources;

use App\CategoryCourse;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryToFilterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $subCategory = CategoryCourse::where('parent_id', $this->id)->where('level' , 2)->get();

        if ($this->resource) :
            $data = [
                'key'           => $this->id,
                'name'          => $this->name,
                'level'         => '1',
                'image'         => $this->hasMedia('catCourse') ? $this->lastMedia('catCourse')->getUrl():null,
                'subCategory'   => count($subCategory) > 0 ? CategoryLevelTwoResource::collection($subCategory) : null
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
