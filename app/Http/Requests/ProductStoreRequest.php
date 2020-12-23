<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'barcode' => 'required|numeric|digits:13',
            'description' => 'required|min:5|max:256',
            'company_id' => 'required|numeric|min:1',
        ];
    }
}
