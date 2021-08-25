<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherProfileResource extends JsonResource
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
                'image'                 => $this->hasMedia('userAvatar') ? $this->lastMedia('userAvatar')->getUrl() : null,
                'type'                  => $this->type,
                'email'                 => $this->email,
                'phone'                 => $this->phone,
                'country'               => $this->country,
                'qualifications'        => $this->qualifications,
                'whatsApp'              => $this->whatsApp,
                'facebook'              => $this->facebook,
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
