<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',   
            'email' => 'sometimes|email|unique:users',          
            'phone' => 'sometimes|string|max:255',            
            'role' => 'sometimes|string',              
            'designation' => 'sometimes|string',       
            'img' => 'sometimes|mimes:jpeg,png,jpg|max:2048',         
            'birthday' => 'sometimes|date',

            'company_name' => 'sometimes|string',
            'website' => 'sometimes|url',           
            'pan_number' => 'sometimes|string|max:20',
            'gst_number' => 'sometimes|string|max:15',
            'social_links' => 'sometimes|url',                

            'house_no' => 'sometimes|string',               
            'street' => 'sometimes|string',     
            'landmark' => 'sometimes|string',   
            'post_code' => 'sometimes|string|max:10',    
            'city' => 'sometimes|string',   
            'state' => 'sometimes|string',
            'country' => 'sometimes|string', 
        ];
    }
}
