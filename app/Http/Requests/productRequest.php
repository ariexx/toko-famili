<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class productRequest extends FormRequest
{
    public function rules()
    {
        return [
            'category_id' => ['required'],
            'name' => ['required'],
            'price' => ['required', 'integer'],
            'description' => ['required'],
            'quantity' => ['required', 'integer'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
