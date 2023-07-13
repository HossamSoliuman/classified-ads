<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCareerEnquireRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'post_for_apply' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'skill' => 'required|string|max:255',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ];
    }
}
