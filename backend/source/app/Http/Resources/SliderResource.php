<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
                'key'       => $this->id,
                'name'      => $this->header,
                'image'     => $this->lastMedia('slider')->getUrl(),
                'paragraph' => $this->paragraph,
                'btn_name'  => $this->btn_name,
                'btn_url'   => $this->url,
                'direction' => $this->direction,
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
