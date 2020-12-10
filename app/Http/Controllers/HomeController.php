<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $user = Auth::user();
        
        $params = [
            'user' => $user,
            'products' => Product::where('company_id', $user->company->id)
                                 ->where('expiration_dates', '<>', null)
                                 ->orderBy('description')->paginate(15),
        ];

        return view('home/index', $params);
    }
}
