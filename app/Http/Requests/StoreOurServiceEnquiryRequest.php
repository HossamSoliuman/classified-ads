<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOurServiceEnquiryRequest extends FormRequest
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
            'name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'contact_number' => 'required|string',
            'email' => 'required|email',
            'company_name' => 'required|string',
            'website' => 'required|url',
            'service_id' => 'required|exists:services,id',
            'enquirement' => 'required|string',
        ];
    }
}
