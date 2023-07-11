<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // change this to appropriate authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'image' => 'required|image|max:2048',
            'link' => 'required|url',
            'parent_id' => 'required|integer|exists:categories,id|required_if:type,category|exists:sub_categories,id|required_if:type,subcategory',
            'type' => 'required|in:category,subcategory',
        ];
    }
}
