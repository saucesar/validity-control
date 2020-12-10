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
            'products' => $user->approved_access ? $this->getProducts($user) : null,
        ];

        return view('home/index', $params);
    }

    private function getProducts($user)
    {
        return Product::where('company_id', $user->company->id)
                      ->where('expiration_dates', '<>', null)
                      ->orderBy('description')->paginate(15);
    }
}
