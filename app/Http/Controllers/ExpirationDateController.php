<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExpirationDateRequest;
use App\Models\ExpirationDate;

class ExpirationDateController extends Controller
{
    public function store(ExpirationDateRequest $request, $id)
    {
        $data = $request->all();
        $data['product_id'] = $id;
        $data['user_id'] = Auth::user()->id;

        ExpirationDate::create($data);

        return back()->with('success', 'Data adicionada!');
    }

    public function update(Request $request, $id)
    {
        $expdate = ExpirationDate::find($id);
        if(isset($expdate)){
            $data = $request->all();
            if(isset($request->newAmount)){
                $data['amount'] = $request->newAmount;
            }
            $data['date'] = $expdate->date;
            $data['product_id'] = $expdate->product_id;
            $data['previous_id'] = $expdate->id;
            $data['user_id'] = Auth::user()->id;
            ExpirationDate::create($data);
            $expdate->delete();
            
            return back()->with('success', 'Data atualizada');
        } else {
            return back()->with('error', 'A data informada não existe!');
        }
    }

    public function restorePrevious(Request $request, $id)
    {
        $expdate = ExpirationDate::find($id);

        if($expdate) {
            $expdate->previous->restore();
            $expdate->forceDelete();
            
            return back()->with('success', 'Alteração desfeita!');
        } else {
            return back()->with('error', 'Data não encontrada!');
        }
    }

    public function destroy(Request $request, $id)
    {
        $date = ExpirationDate::find($id);
        $date->delete();
     
        if(isset($request->redirect)){
            return redirect()->route('products.index')->with('success', 'Data removida com sucesso!');
        } else {
            return back()->with('success', 'Data removida com sucesso!');
        }
    }

}
