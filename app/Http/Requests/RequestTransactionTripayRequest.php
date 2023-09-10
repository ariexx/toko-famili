<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestTransactionTripayRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'merchant_code' => 'required|string',
            'merchant_ref' => 'required|string',
            'method' => 'required|string',
            'customer_name' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
