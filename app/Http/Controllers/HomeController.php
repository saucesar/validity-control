<?php

namespace App\Http\Controllers;

use App\Models\ExpirationDate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $user = Auth::user();

        $params = [
            'user' => $user,
            'access_requests' => $user->getAccessRequests(),
            'critical_date' => ExpirationDate::byDays($user->company->id),
            'users_granted' => $user->isCompanyOwner() ? User::where('company_id', $user->company->id)
                                                             ->where('access_granted', true)
                                                             ->where('id', '<>', $user->id)
                                                             ->get()
                                                       : null,
        ];

        return view('home/index', $params);
    }
}
