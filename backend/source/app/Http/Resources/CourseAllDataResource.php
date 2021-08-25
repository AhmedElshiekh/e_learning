<?php

namespace App\Http\Resources;

use App\CategoryCourse;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseAllDataResource extends JsonResource
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
                'mainCategory'          => $this->parent_cat_id,
                'category'              => $this->sub_cat_id,
                'subCategory'           => $this->course_cat_id,
                'slug'                  => $this->slug,
                'image'                 => $this->hasMedia('Course') ? $this->firstMedia('Course')->getUrl() : null,
                'discountPrice'         => $this->discountPrice,
                'price'                 => $this->price,
                'short_description'     => $this->sh_desc,
                'description'           => $this->desc,
                'WhatWillLearn'         => $this->contact,
                'requirements'          => $this->prerequisite,
                'level'                 => $this->level->name,
                'teachers'              => TeacherResource::collection($this->teachers),
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
