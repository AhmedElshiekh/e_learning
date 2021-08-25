<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScoreResource extends JsonResource
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
                'score'   => $this->score,
                'total'   => $this->total,
                'pass'    => $this->pass,
                'rate'    => $this->rate,
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
