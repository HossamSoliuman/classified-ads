<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'start_date' => 'required|date',
            // 'status' => 'required|string',
            // 'user_id' => 'required|integer|exists:users,id',
            'badge' => 'required|string',
            'product_title' => 'required|string',
            'address' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'contact_no' => 'required|string',
            'opening_hours' => 'required|string',
            'year_of_establishment' => 'required|integer|min:1900|max:' . date('Y'),
            'gstn' => 'required|string',
            'pan' => 'required|string',
            'social_links' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'sub_category_id' => 'required|integer|exists:sub_categories,id',
            'product_type_id' => 'required|integer|exists:product_types,id',
            'price_type_id' => 'required|integer|exists:price_types,id',
            'unit_type_id' => 'required|integer|exists:unit_types,id',
            'order_type_id' => 'required|integer|exists:order_types,id',
            'mode_of_payment_id' => 'required|integer|exists:mode_of_payments,id',
            'area_id' => 'required|integer|exists:areas,id',
            'offer_type_id' => 'required|integer|exists:offer_types,id',
            'return_policy' => 'required|string',
            'features' => 'required|string',
            'product_description' => 'required|string',
            'company_description' => 'required|string',
            'images' => 'required|array|max:7',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}