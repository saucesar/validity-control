<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserResquest;
use App\Http\Requests\UpdateUserResquest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $logged = Auth::attempt($request->only(['email', 'password']), isset($request->remember));
    
        if($logged){
            $name = Auth::user()->name;
            return redirect()->route('home.index')->with('success', "Bem Vindo $name!");
        } else {
            return back()->with('error', 'Login Inválido!')->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    public function accessRequest($user, $status)
    {
        $requesting_user = User::find($user);

        if(!isset($requesting_user)){
            return back()->with('error', 'Usuário não encontrado!');
        }

        $requesting_user->access_granted = ($status == 'granted');
        $requesting_user->access_denied = !$requesting_user->access_granted;

        $requesting_user->save();

        $msg = $requesting_user->access_granted ? 'Acesso permitido!' : 'Acesso bloqueado!';

        return back()->with('success', $msg);
    }

    public function store(StoreUserResquest $request)
    {
        $access_granted = false;

        if(is_numeric($request->company)){
            $company = Company::find($request->company);
        } else {
            $company = Company::create(['name' => $request->company]);
            $access_granted = true;
        }        
        if(!isset($company)){
            return back()->with('error', 'Empresa informada não existe!');
        }

        $data = $request->all();
        $data['company_id'] = $company->id;
        $data['access_granted'] = $access_granted;

        $user = User::create($data);

        if(isset($user)){
            Auth::login($user, true);
            return redirect()->route('home.index')->with('success', "Bem vindo {$user->name}");
        } else {
            return back()->with('error', 'Não foi possível completar o cadastro!');
        }
    }

    public function create()
    {
        return view('users.new_user');
    }

    public function update(UpdateUserResquest $request, $id)
    {
        $user = User::find($id);
            
        if(!isset($user)){
            return back()->with('error', 'Usuário não encontrado !!');
        } else if(Hash::check($request->oldpass, $user->password)){
            $data = $request->all();
            $data['password'] = bcrypt($request->newpass);

            $user->update($data);
            return back()->with('success', 'Informações Atualizadas!');
        } else {
            return back()->with('error', 'A senha antiga está errada!')->withInput();
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
            
        if(isset($user)){
            $user->delete();
            return redirect()->route('root')->with('success', 'Usuário deletado!');
        } else {
            return back()->with('error', 'Usuário não encontrado!');
        }
    }

    public function information()
    {
        $params = [
            'user' => Auth::user(),
        ];

        return view('users/info', $params);
    }
}