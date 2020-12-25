<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpirationDateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date' => 'required|date|after:today',
            'amount' => 'required|numeric|min:1',
        ];
    }
}
