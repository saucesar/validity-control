<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $user = Auth::user();

        $params = [
            'user' => $user,
            'products' => $this->getProducts($user),
            'access_requests' => $this->getAccessRequests($user),
        ];

        return view('home/index', $params);
    }

    private function getProducts($user)
    {
        return $user->access_granted ? Product::where('company_id', $user->company->id)->orderBy('description')->paginate(15) : null;
    }

    private function getAccessRequests($user)
    {
        if(!$user->isCompanyOwner()){
            return null;
        }
        
        $requests = User::where('company_id', $user->company->id)
                        ->where('access_granted', false)
                        ->where('access_denied', false);
        
        return $requests->exists() ? $requests->get() : null;
    }
}
