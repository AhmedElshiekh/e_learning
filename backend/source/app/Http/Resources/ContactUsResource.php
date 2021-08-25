<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactUsResource extends JsonResource
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
                'phone'         => setting('general.phone_number'),
                'email'         => setting('general.contact_email'),
                'address'       => setting('general.address'),
                'location'      => setting('general.map_iframe_link'),
                'whatsapp'      => setting('general.whatsapp_number'),
                'facebook'      => setting('general.facebook_page_link'),
                'twitter'       => setting('general.twitter_page_link'),
                'linkedin'      => setting('general.linkedin_page_link'),
                'instagram'     => setting('general.instagram_page_link'),
                'youTube'       => setting('general.youTube_page_link'),
            ];
        else :
            $data = null;
        endif;

        return $data;
    }
}
