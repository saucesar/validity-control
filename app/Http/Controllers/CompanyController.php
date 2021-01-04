<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCompanyNameRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    public function update(UpdateCompanyNameRequest $request,$id)
    {
        $company = Company::find($id);
        $company->update(['name' => $request->company_name]);
        return back()->with('success', 'Empresa atualizada!');
    }
}
