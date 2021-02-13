<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rule = auth()->user()->role == 'owner' ? 'required|max:255' : 'max:255';
        
        return [
            'name' => $rule,
            'cnpj' => 'required|size:18',
        ];
    }
}
