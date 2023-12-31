<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdRequest extends FormRequest
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
            'start_date' => 'nullable|date',
            // 'status' => 'nullable|string',
            // 'user_id' => 'nullable|integer|exists:users,id',
            'badge' => 'nullable|string',
            'product_title' => 'nullable|string',
            'address' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'contact_no' => 'nullable|string',
            'opening_hours' => 'nullable|string',
            'year_of_establishment' => 'nullable|integer|min:1900|max:' . date('Y'),
            'gstn' => 'nullable|string',
            'pan' => 'nullable|string',
            'social_links' => 'nullable|string',
            'category_id' => 'nullable|integer|exists:categories,id',
            'sub_category_id' => 'nullable|integer|exists:sub_categories,id',
            'product_type_id' => 'nullable|integer|exists:product_types,id',
            'price_type_id' => 'nullable|integer|exists:price_types,id',
            'unit_type_id' => 'nullable|integer|exists:unit_types,id',
            'order_type_id' => 'nullable|integer|exists:order_types,id',
            'mode_of_payment_id' => 'nullable|integer|exists:mode_of_payments,id',
            'area_id' => 'nullable|integer|exists:areas,id',
            'offer_type_id' => 'nullable|integer|exists:offer_types,id',
            'return_policy' => 'nullable|string',
            'features' => 'nullable|string',
            'product_description' => 'nullable|string',
            'company_description' => 'nullable|string',
            'images' => 'nullable|array|max:7',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}