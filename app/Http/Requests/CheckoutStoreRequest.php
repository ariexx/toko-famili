<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_uuid' => 'required|exists:users,uuid',
            'product_uuid' => 'required|exists:products,uuid',
            'product_uuid.*' => 'required|exists:products,uuid',
            'quantity' => 'required|numeric|min:1',
            'quantity.*' => 'required|numeric|min:1',
            'total' => 'required|numeric|min:1',
            'total.*' => 'required|numeric|min:1',
            'status' => 'required|in:pending,success,failed',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
