<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
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
                'key'               =>  $this->id,
                'name'              =>  $this->name,
                'country'           =>  $this->country,
                'qualifications'    =>  $this->qualifications,
                'whatsApp'          =>  $this->whatsApp,
                'facebook'          =>  $this->facebook,
                'image'             =>  $this->hasMedia('userAvatar') ? $this->lastMedia('userAvatar')->getUrl():null
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
