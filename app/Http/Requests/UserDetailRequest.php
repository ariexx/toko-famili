<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDetailRequest extends FormRequest
{
    public function rules()
    {
        return [
            'uuid' => ['required'],
            'user_uuid' => ['required'],
            'street_detail' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
