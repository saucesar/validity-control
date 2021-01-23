<?php

namespace App\Http\Controllers;

use App\Http\Requests\AmountInOutRequest;
use App\Models\AmountInOut;
use App\Models\ExpirationDate;
use Illuminate\Support\Facades\Auth;

class AmountInOutController extends Controller
{
    public function store(AmountInOutRequest $request, $expDateId)
    {
        $expDate = ExpirationDate::find($expDateId);
        
        if(isset($expDate)){
            if($request->type == 'in'){
                $msg = 'Entrada registrada!';
                
                $expDate->amount += $request->amount;
            } else {
                $msg = 'Saída registrada!';
                if($request->amount > $expDate->amount){
                    return back()->with('error', 'A quantidade de saida dever ser menor ou igual a quantidade do item.');
                } else {
                    $expDate->amount -= $request->amount;
                }
            }

            $data = $request->all();
            $data['exp_date_id'] = $expDateId;
            $data['user_id'] = Auth::user()->id;

            AmountInOut::create($data);
            $expDate->save();

            return back()->with('success', $msg);
        }
    }
}
