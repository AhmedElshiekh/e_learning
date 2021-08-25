<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutUsResource extends JsonResource
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
                'image'         => $this->hasMedia('about') ? $this->firstMedia('about')->getUrl():null,
                'sh_desc'       => $this->sh_desc,
                'full_desc'     => $this->description,
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
