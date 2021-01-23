<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AmountInOutRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'amount' => 'required|numeric|min:1',
            'type' => 'required|in:in,out',
            'reason' => 'required_if:type,out',
        ];
    }
}
