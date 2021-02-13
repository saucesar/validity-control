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
            'critical_dates' => $user->access_granted ? ExpirationDate::byDays($user->company->id) : null,
            'expired_products' => $user->access_granted ? ExpirationDate::expired($user->company->id) : null,
            'users_granted' => $user->isCompanyOwner() ? $user->usersGranted() : null,
            'graphic_data' => $user->access_granted ? $this->graphicData($user) : null,
        ];

        return view('home/index', $params);
    }

    private function graphicData(User $user)
    {
        $array = [
            ['Categoria', 'Produtos por categoria'],
        ];

        foreach($user->company->categories as $category){
            $array[] = [$category->name, $user->queryProductsByExpDate(30)->where('category_id', $category->id)->count()];
        }
        
        return json_encode($array);
    }
}
