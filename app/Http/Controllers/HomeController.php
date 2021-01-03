<?php

namespace App\Http\Controllers;

use App\Models\ExpirationDate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function checkLogin()
    {
        if(Auth::user()){
            return redirect()->route('home.index');
        } else {
            return view('auth.login');
        }
    }

    public function index(){
        $user = Auth::user();

        $params = [
            'user' => $user,
            'access_requests' => $user->accessRequests(),
            'critical_date' => $user->access_granted ? ExpirationDate::byDays($user->company->id) : null,
            'users_granted' => $user->isCompanyOwner() ? User::where('company_id', $user->company->id)
                                                             ->where('access_granted', true)
                                                             ->where('id', '<>', $user->id)
                                                             ->get()
                                                       : null,
        ];

        return view('home/index', $params);
    }
}
