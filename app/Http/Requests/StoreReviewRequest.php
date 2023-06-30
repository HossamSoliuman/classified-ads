<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // set to true to allow anyone to make the request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' =>auth()->id(),
            'ad_id' => 'required|integer|exists:ad,id',
            'body' => 'required|string',
            'number_of_stars' => 'required|integer|between:1,5',
        ];
    }
}