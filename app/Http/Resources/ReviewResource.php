<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'ad_id' => $this->ad_id,
            'body' => $this->body,
            'number_of_stars' => $this->number_of_stars,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}