<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FeatureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $image = $this->hasMedia('feature')? $this->lastMedia('feature')->getUrl():null;
        if ($this->resource) :
            $data = [
                'key'           => $this->id,
                'name'          => $this->title,
                'image'         => $image,
                'description'   => $this->desc,
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
