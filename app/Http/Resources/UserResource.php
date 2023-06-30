<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'role' =>$this->role,
            'name' => $this->first_name . ' ' . $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'image' => $this->image,
            'birthday' => $this->birthday,
            'company_name' => $this->company_name,
            'website' => $this->website,
            'pan_number' => $this->pan_number,
            'gst_number' => $this->gst_number,
            'social_links' => $this->social_links,
            'address' => [
                'house_no' => $this->house_no,
                'street' => $this->street,
                'landmark' => $this->landmark,
                'post_code' => $this->post_code,
                'city' => $this->city,
                'state' => $this->state,
                'country' => $this->country,
            ],
        ];
    }
}