<?php

namespace App\Http\Resources;

use App\CategoryCourse;
use Illuminate\Http\Resources\Json\JsonResource;

class LiveCourseDetailsResource extends JsonResource
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
                'owner'                 => $this->owner,
                'name'                  => $this->name,
                'slug'                  => $this->slug,
                'category'              => CategoryCourse::find( $this->sub_cat_id)->name,
                'subCategory'           => CategoryCourse::find( $this->course_cat_id)->name,
                'image'                 => $this->hasMedia('Course') ? $this->firstMedia('Course')->getUrl() : null,
                'discountPrice'         => $this->discountPrice,
                'price'                 => $this->price,
                'short_description'     => $this->sh_desc,
                'description'           => $this->desc,
                'WhatWillLearn'         => $this->contact,
                'requirements'          => $this->prerequisite,
                'level'                 => $this->level->name,

                'teachers'              => TeacherResource::collection($this->teachers),

                'lessons'               => $this->lessons,
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
