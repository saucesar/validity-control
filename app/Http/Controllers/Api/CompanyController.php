<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index()
    {
        return response()->json(Company::all());
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), ['name' => 'required|min:5']);

        if($validation->fails()){
            return response()->json($validation->errors());
        } else {
            return response()->json(['message' => 'Company created!']);
        }
    }

    public function show($id)
    {
        $company = Company::find($id);
        
        if(isset($company)){
            return response()->json($company);
        } else {
            return response()->json(['message' => 'Company not found!'], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        
        $validation = Validator::make($request->all(), ['name' => 'required|min:5']);
        
        if($validation->fails()){
            return response()->json($validation->errors());
        } else { 
            if(isset($company)){
                $company->update($request->all());
                return response()->json(['Company updated!']);
            } else {
                return response()->json(['message' => 'Company not found!'], 400);
            }
        }
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        
        if(isset($company)){
            $company->delete();
            return response()->json(['message' => 'Company deleted!']);
        } else {
            return response()->json(['message' => 'Company not found!'], 400);
        }
    }
}