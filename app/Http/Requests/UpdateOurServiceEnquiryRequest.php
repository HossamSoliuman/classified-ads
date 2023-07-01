<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOurServiceEnquiryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'nullable|sometimes|string',
            'address' => 'nullable|sometimes|string',
            'city' => 'nullable|sometimes|string',
            'contact_number' => 'nullable|sometimes|numeric',       
            'email' => 'nullable|sometimes|email',        
            'company_name' => 'nullable|sometimes|string',      
            'website' => 'nullable|sometimes|url',        
            'service_id' => 'nullable|sometimes|integer',        
            'enquirement' => 'nullable|sometimes|string',
        ];
    }
}
