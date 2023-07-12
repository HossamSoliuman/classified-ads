<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
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
            'id'=>$this->id,
            'start_date' => $this->start_date,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'badge' => $this->badge,
            'product_title' => $this->product_title,
            'address' => $this->address,
            'state' => $this->state,
            'city' => $this->city,
            'contact_no' => $this->contact_no,
            'opening_hours' => $this->opening_hours,
            'year_of_establishment' => $this->year_of_establishment,
            'gstn' => $this->gstn,
            'pan' => $this->pan,
            'social_links' => json_decode($this->social_links),
            'category' => $this->category,
            'sub_category' => $this->subCategory,
            'return_policy' => $this->returnPolicy->name,//
            'product_type' => $this->productType->name,
            'price_type' => $this->priceType->name,
            'unit_type' => $this->unitType->name,
            'order_type' => $this->orderType->name,
            'mode_of_payment' => $this->modeOfPayment->name,
            'area' => $this->area->name,
            'offer_type' => $this->offerType->name,
            'features' => $this->features,
            'product_description' => $this->product_description,
            'company_description' => $this->company_description,
            // 'featured' => $this->featured,
            'rating' => number_format($this->rating, 1),
        ];
    }
}
