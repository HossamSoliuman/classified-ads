<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoresliderRequest extends FormRequest
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
            'position' => 'required|string',
            'image' => 'required|image',
            'url' => 'nullable|url',
            'description' => 'nullable|string'
        ];
    }
}
