<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
                'key'    => $this->id,
                'name'   => $this->name,
                'email'  => $this->email,
                'phone'  => $this->phone,
                'msg'    => $this->note,
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
