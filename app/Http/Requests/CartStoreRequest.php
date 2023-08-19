<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_uuid' => "exists:products,uuid",
            'type' => 'string',
            'quantity' => 'numeric',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
