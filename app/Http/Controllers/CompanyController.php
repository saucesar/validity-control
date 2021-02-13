<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\UpdateCompanyNameRequest;
use App\Models\Company;
use App\Models\User;

class CompanyController extends Controller
{
    public function create()
    {
        return view('companies.create');
    }

    public function store(CompanyStoreRequest $request) {
        $user = auth()->user();

        if($user->role == 'owner') {
            $data = $request->all();
            $data['owner_id'] = $user->id;
            $company = Company::create($data);

            if(isset($company)) {
                $user->company_id = $company->id;
                $user->access_granted = true;
    
                $user->save();
    
                return redirect()->route('home.index')->with('success', 'Empresa cadastrada.');
            } else {
                return back()->with('error', 'Falha ao salvar!');
            }
        } else {
            $company = Company::where('cnpj', $request->cnpj)->first();
            
            if(isset($company)){
                $user->company_id = $company->id;
                $user->save();

                return redirect()->route('home.index')->with('success', 'Solicitação de acesso enviada!');
            } else {
                return back()->with('error', 'Empresa não encontrada!');
            }
        }

    }

    public function update(UpdateCompanyNameRequest $request,$id)
    {
        $company = Company::find($id);
        $company->update(['name' => $request->company_name]);
        return back()->with('success', 'Empresa atualizada!');
    }
}
