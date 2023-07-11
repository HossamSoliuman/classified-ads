<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
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
            'date' => 'nullable|date',
            'membership' => 'nullable|string',
            'service' => 'nullable|string',
            'amount' => 'nullable|numeric|min:0',
            'payment_mode' => 'nullable|string',
            'status' => 'nullable|string',
        ];
    }
}
